<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

/**
 * Cache HTML ra file (nén gzip), đồng bộ logic với hoptackinhdoanh.dev.
 * Dùng config: admin.cache (folderSave, disk, extension), app.cache_html_time.
 */
class HtmlCacheService
{
    protected $disk;
    protected $cacheFolder;
    protected $fileTtl;
    protected $extension;
    protected $useHtmlCache;

    public function __construct()
    {
        $this->useHtmlCache = config('admin.cache.enable');
        $this->fileTtl      = config('app.cache_html_time', 2592000);
        $this->cacheFolder  = rtrim(config('admin.cache.folderSave'), '/');
        $this->extension   = config('admin.cache.extension', 'html');
        $this->disk         = Storage::disk(config('admin.cache.disk', 'local'));
    }

    /**
     * Lấy HTML từ cache (nếu bật và còn hạn) hoặc render và lưu cache.
     *
     * @param string $cacheKey Tên cache không có extension (vd: 'trang-chu', 'tai-tai-lieu')
     * @param callable $renderCallback Closure trả về HTML
     * @param bool $saveCache Có lưu vào cache sau khi render không (vd: trang tìm kiếm = false)
     * @return string
     */
    public function getOrRender(string $cacheKey, callable $renderCallback, bool $saveCache = true): string
    {
        if (!$this->useHtmlCache) {
            return $renderCallback();
        }

        $cachePath = $this->buildCachePath($cacheKey);
        $html = $this->getFromFile($cachePath);
        if ($html !== null) {
            return $html;
        }

        $html = $renderCallback();
        if ($saveCache && $html !== null && $html !== '') {
            $this->saveToFile($cachePath, $html);
        }

        return $html ?? '';
    }

    /**
     * Xóa một file cache theo key.
     */
    public function clear(string $cacheKey): void
    {
        $cachePath = $this->buildCachePath($cacheKey);
        $gzPath = $cachePath . '.gz';
        if ($this->disk->exists($gzPath)) {
            $this->disk->delete($gzPath);
        }
        if ($this->disk->exists($cachePath)) {
            $this->disk->delete($cachePath);
        }
    }

    private function buildCachePath(string $cacheKey): string
    {
        $key = ltrim(str_replace(['/', '\\'], '-', $cacheKey), '-');
        return $this->cacheFolder . '/' . $key . '.' . $this->extension;
    }

    private function saveToFile(string $path, string $content): void
    {
        $this->disk->makeDirectory($this->cacheFolder);
        $compressed = gzencode($content, 6);
        $this->disk->put($path . '.gz', $compressed);
    }

    private function getFromFile(string $path): ?string
    {
        $gzPath = $path . '.gz';
        if (!$this->disk->exists($gzPath)) {
            return null;
        }
        $lastModified = $this->disk->lastModified($gzPath);
        if ((time() - $lastModified) > $this->fileTtl) {
            return null;
        }
        $compressed = $this->disk->get($gzPath);
        $decoded = @gzdecode($compressed);
        return $decoded !== false ? $decoded : null;
    }
}
