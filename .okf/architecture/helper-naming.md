---
type: Architecture
title: Helper naming
description: Runtime helpers use exact CUDA names; GL helpers use cudaGL_* over CudaGL
tags: [cuda, architecture, helpers, naming]
status: draft
resource: ../src/Helpers/
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: runtime
    resource: ../src/Helpers/cuda-runtime.php
    title: Runtime helpers
  - id: gl
    resource: ../src/Helpers/cuda-gl.php
    title: GL interop helpers
  - id: coverage-map
    resource: ../tests/Support/extension-methods-0.7.0.php
    title: Frozen ext-cuda 0.7.0 method map
  - id: coverage-test
    resource: ../tests/Unit/CoverageTest.php
    title: Helper coverage Pest tests
---

# Two naming rules

| File | Helper names | Extension target |
|------|--------------|------------------|
| `src/Helpers/cuda-runtime.php` | **Identical** to CUDA Runtime / `Cuda::` method names | `Cuda\Cuda\Cuda::{name}`[^runtime] |
| `src/Helpers/cuda-gl.php` | Prefixed `cudaGL_{method}` | `Cuda\Cuda\CudaGL::{method}`[^gl] |

GL helpers are prefixed so short extension method names (`map`, `clear`, …) do not collide with unrelated globals.[^gl]

# Coverage contract (0.7.0)

`tests/Support/extension-methods-0.7.0.php` freezes the public static surfaces this package must wrap.[^coverage-map] `CoverageTest` asserts:

* Every Runtime method has an identically named helper, and helper count matches the map.[^coverage-test]
* Every CudaGL method has a `cudaGL_{method}` helper, and helper count matches the map.[^coverage-test]
* When `ext-cuda` is loaded, live reflection of `Cuda` / `CudaGL` matches the frozen map.[^coverage-test]

# Runtime surface (frozen)

Device / error: `cudaGetDeviceCount`, `cudaSetDevice`, `cudaGetDevice`, `cudaGetDeviceProperties`, `cudaDeviceSynchronize`, `cudaDeviceReset`, `cudaGetLastError`, `cudaPeekAtLastError`, `cudaGetErrorString`, `cudaGetErrorName`

Memory: `cudaMalloc`, `cudaFree`, `cudaMallocHost`, `cudaFreeHost`, `cudaMemcpyHtoD`, `cudaMemcpyDtoH`, `cudaMemcpyDtoD`, `cudaMemset`

Stream / event: `cudaStreamCreate`, `cudaStreamDestroy`, `cudaStreamSynchronize`, `cudaEventCreate`, `cudaEventDestroy`, `cudaEventRecord`, `cudaEventSynchronize`, `cudaEventElapsedTime`

# GL surface (frozen → `cudaGL_*`)

`createPixelUnpackBuffer`, `deleteBuffer`, `createTextureRGBA`, `deleteTexture`, `registerBuffer`, `unregister`, `map`, `unmap`, `launchPlasma`, `uploadPBOToTexture`, `clear`, `drawFullscreenTexture`, `fillRect`

# See also

* [DTO passthrough](./dto-passthrough.md)
* [Helpers-only](../conventions/helpers-only.md)

[^runtime]: Runtime helpers
[^gl]: GL interop helpers
[^coverage-map]: Frozen ext-cuda 0.7.0 method map
[^coverage-test]: Helper coverage Pest tests
