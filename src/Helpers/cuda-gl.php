<?php

use Cuda\Cuda\CudaDevicePtr;
use Cuda\Cuda\CudaGL;
use Cuda\Cuda\CudaGraphicsResource;
use Microscrap\Bindings\CUDA\Enums\CudaGraphicsRegisterFlags;

/*
|--------------------------------------------------------------------------
| CUDA–OpenGL interop helpers — 1:1 over ext-cuda (Cuda\Cuda\CudaGL)
|--------------------------------------------------------------------------
| Prefixed cudaGL_* so short extension method names do not collide with
| unrelated globals. Extension DTOs are passed through unchanged.
| Do not cudaFree() a device pointer obtained from cudaGL_map().
*/

if (! function_exists('cudaGL_createPixelUnpackBuffer')) {
    function cudaGL_createPixelUnpackBuffer(int $bytes): int
    {
        return CudaGL::createPixelUnpackBuffer($bytes);
    }
}

if (! function_exists('cudaGL_deleteBuffer')) {
    function cudaGL_deleteBuffer(int $glBuffer): void
    {
        CudaGL::deleteBuffer($glBuffer);
    }
}

if (! function_exists('cudaGL_createTextureRGBA')) {
    function cudaGL_createTextureRGBA(int $width, int $height): int
    {
        return CudaGL::createTextureRGBA($width, $height);
    }
}

if (! function_exists('cudaGL_deleteTexture')) {
    function cudaGL_deleteTexture(int $glTexture): void
    {
        CudaGL::deleteTexture($glTexture);
    }
}

if (! function_exists('cudaGL_registerBuffer')) {
    function cudaGL_registerBuffer(int $glBuffer, CudaGraphicsRegisterFlags|int $flags = 0): CudaGraphicsResource
    {
        $flagValue = $flags instanceof CudaGraphicsRegisterFlags ? $flags->value : $flags;

        return CudaGL::registerBuffer($glBuffer, $flagValue);
    }
}

if (! function_exists('cudaGL_unregister')) {
    function cudaGL_unregister(CudaGraphicsResource $graphics): int
    {
        return CudaGL::unregister($graphics);
    }
}

if (! function_exists('cudaGL_map')) {
    function cudaGL_map(CudaGraphicsResource $graphics): CudaDevicePtr
    {
        return CudaGL::map($graphics);
    }
}

if (! function_exists('cudaGL_unmap')) {
    function cudaGL_unmap(CudaGraphicsResource $graphics): int
    {
        return CudaGL::unmap($graphics);
    }
}

if (! function_exists('cudaGL_launchPlasma')) {
    function cudaGL_launchPlasma(CudaDevicePtr $dst, int $width, int $height, float $time): int
    {
        return CudaGL::launchPlasma($dst, $width, $height, $time);
    }
}

if (! function_exists('cudaGL_uploadPBOToTexture')) {
    function cudaGL_uploadPBOToTexture(int $glBuffer, int $glTexture, int $width, int $height): void
    {
        CudaGL::uploadPBOToTexture($glBuffer, $glTexture, $width, $height);
    }
}

if (! function_exists('cudaGL_clear')) {
    function cudaGL_clear(float $r, float $g, float $b, float $a): void
    {
        CudaGL::clear($r, $g, $b, $a);
    }
}

if (! function_exists('cudaGL_drawFullscreenTexture')) {
    function cudaGL_drawFullscreenTexture(int $glTexture, int $winW, int $winH): void
    {
        CudaGL::drawFullscreenTexture($glTexture, $winW, $winH);
    }
}

if (! function_exists('cudaGL_fillRect')) {
    function cudaGL_fillRect(
        float $x,
        float $y,
        float $w,
        float $h,
        float $r,
        float $g,
        float $b,
        float $a
    ): void {
        CudaGL::fillRect($x, $y, $w, $h, $r, $g, $b, $a);
    }
}
