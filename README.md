# microscrap/cuda

[![Docs](https://img.shields.io/badge/docs-0.7.x-0A7EA4?logo=readthedocs&logoColor=white)](https://scrapyard-io.projectsaturnstudios.com/ecosystem/microscrap/cuda/0.7.x/overview)
[![PHP](https://img.shields.io/badge/php-%E2%89%A5%208.4-777bb4?logo=php&logoColor=white)](https://www.php.net)
[![ext-cuda](https://img.shields.io/badge/ext--cuda-%5E0.7.0-76B900)](https://github.com/php-io-extensions/cuda)
[![Tests](https://github.com/microscrap/cuda/actions/workflows/tests.yml/badge.svg)](https://github.com/microscrap/cuda/actions/workflows/tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/microscrap/cuda.svg?label=packagist)](https://packagist.org/packages/microscrap/cuda)
[![License: MIT](https://img.shields.io/badge/license-MIT-green.svg)](#license)

> **Docs:** [ScrapyardIO ecosystem — microscrap/cuda 0.7.x](https://scrapyard-io.projectsaturnstudios.com/ecosystem/microscrap/cuda/0.7.x/overview)

PHP helper library that wraps the [**cuda** extension](https://github.com/php-io-extensions/cuda) with global functions and enums. Each helper delegates to `Cuda\Cuda\Cuda` / `Cuda\Cuda\CudaGL`.

This is a **1:1 bindings** package (posix / ftdi style). Extension DTOs (`CudaDevicePtr`, `CudaHostPtr`, `CudaStream`, `CudaEvent`, `CudaGraphicsResource`) are passed through unchanged — public `fd` is the opaque native pointer (`0` = none).

Tubes framebuffer registration belongs in **`microscrap/cuda-gfx`** (separate). Windowing stays in **sdl3** / **glfw**.

## Highlights

* C-ish Runtime helpers matching CUDA / ext-cuda names (`cudaMalloc`, `cudaMemcpyHtoD`, …)
* CUDA–OpenGL interop helpers (`cudaGL_*`) over in-package `CudaGL` (embedded plasma PTX)
* Backed PHP enums for error / memcpy / graphics / stream / event flags
* No exceptions in `src/` — check `cudaSuccess` (`0`) and `cudaGetLastError()`
* Coverage + style Pest suite (CI runs without a GPU via `--ignore-platform-req=ext-cuda`)

## Requirements

* PHP 8.4+
* **ext-cuda** ^0.7.0 — install via [PHP PIE](https://github.com/php/pie):

```bash
export CUDA_HOME=/usr/local/cuda
pie install php-io-extensions/cuda:0.7.x-dev
```

## Installation

```bash
php -m | grep cuda
composer require microscrap/cuda
```

Composer autoloads `src/Helpers/cuda-runtime.php` and `src/Helpers/cuda-gl.php`.

## Usage

```php
<?php

use Microscrap\Bindings\CUDA\Enums\CudaError;

$count = cudaGetDeviceCount();
cudaSetDevice(0);
$props = cudaGetDeviceProperties(0);

$dev = cudaMalloc(256);
if ($dev->fd === 0) {
    throw new RuntimeException(cudaGetErrorString(cudaGetLastError()));
}

$err = cudaMemcpyHtoD($dev, random_bytes(256), 256);
if ($err !== CudaError::CUDA_SUCCESS->value) {
    throw new RuntimeException(cudaGetErrorString($err));
}

$back = cudaMemcpyDtoH($dev, 256);
cudaFree($dev);
```

GPU-owned framebuffer (needs a current GL context from sdl3):

```php
$pbo = cudaGL_createPixelUnpackBuffer($w * $h * 4);
$tex = cudaGL_createTextureRGBA($w, $h);
$res = cudaGL_registerBuffer($pbo);
$mapped = cudaGL_map($res);
cudaGL_launchPlasma($mapped, $w, $h, $t);
cudaGL_unmap($res);
cudaGL_uploadPBOToTexture($pbo, $tex, $w, $h);
cudaGL_drawFullscreenTexture($tex, $winW, $winH);
```

## Enums

| Enum | Role |
|------|------|
| `Microscrap\Bindings\CUDA\Enums\CudaError` | `cudaError_t` |
| `CudaMemcpyKind` | memcpy directions (docs; ext uses dedicated HtoD/DtoH/DtoD) |
| `CudaGraphicsRegisterFlags` | `cudaGL_registerBuffer` flags |
| `CudaStreamFlags` / `CudaEventFlags` | create-with-flags tokens |

## Documentation

* **Production docs:** https://scrapyard-io.projectsaturnstudios.com/ecosystem/microscrap/cuda/0.7.x/overview
* Native extension docs: https://scrapyard-io.projectsaturnstudios.com/ecosystem/php-io-extensions/cuda/0.7.x/overview
* Agent knowledge bundle: [`.okf/`](.okf/) (excluded from Composer dist)

## License

MIT © Angel Gonzalez
