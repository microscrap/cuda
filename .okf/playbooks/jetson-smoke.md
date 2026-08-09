---
type: Playbook
title: Jetson smoke with ext-cuda
description: Minimal Runtime smoke on Jetson after ext-cuda + microscrap/cuda are installed
tags: [cuda, playbooks, jetson, smoke]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: readme
    resource: ../README.md
    title: Package README
  - id: runtime
    resource: ../src/Helpers/cuda-runtime.php
    title: Runtime helpers
---

# Goal

Prove helpers reach the device: alloc → HtoD → DtoH → free, with C-style error checks (exceptions only in the **caller**, not in `src/`).[^readme]

# Prerequisites

* Jetson (or Ubuntu/WSL) with NVIDIA CUDA stack
* **ext-cuda** installed (PIE / package host process as documented by php-io-extensions/cuda)
* `microscrap/cuda` required and autoloaded

# Smoke script (sketch)

```php
<?php

use Microscrap\Bindings\CUDA\Enums\CudaError;

require 'vendor/autoload.php';

$count = cudaGetDeviceCount();
if ($count < 1) {
    fwrite(STDERR, "no CUDA devices\n");
    exit(1);
}

cudaSetDevice(0);
$dev = cudaMalloc(256);
if ($dev->fd === 0) {
    fwrite(STDERR, cudaGetErrorString(cudaGetLastError()) . "\n");
    exit(1);
}

$err = cudaMemcpyHtoD($dev, random_bytes(256), 256);
if ($err !== CudaError::CUDA_SUCCESS->value) {
    fwrite(STDERR, cudaGetErrorString($err) . "\n");
    cudaFree($dev);
    exit(1);
}

$back = cudaMemcpyDtoH($dev, 256);
cudaFree($dev);

echo 'ok bytes=' . strlen($back) . PHP_EOL;
```

# Optional GL path

Requires a current GL context (typically from sdl3/glfw). Follow README’s register → map → `cudaGL_launchPlasma` → unmap → upload/draw sketch. Never `cudaFree` the mapped pointer — see [Do not cudaFree mapped GL ptr](../traps/do-not-cudafree-mapped-gl.md).[^readme]

# Success criteria

* Script prints `ok bytes=256` (or equivalent)
* No extension class-not-found / undefined function errors
* Errors reported via `cudaGetErrorString`, not package throws

# See also

* [Composer require and verify helpers](./composer-require-verify.md)
* [Helper naming](../architecture/helper-naming.md)

[^readme]: Package README
[^runtime]: Runtime helpers
