---
type: Architecture
title: DTO passthrough
description: Extension DTOs pass through unchanged — no DataObject re-wrap of fd
tags: [cuda, architecture, dto, fd]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: readme
    resource: ../README.md
    title: Package README
  - id: runtime
    resource: ../src/Helpers/cuda-runtime.php
    title: Runtime helpers
  - id: gl
    resource: ../src/Helpers/cuda-gl.php
    title: GL interop helpers
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
---

# Rule

Helpers **return and accept** extension schema objects from `Cuda\Cuda\` directly. This package does **not** define microscrap DataObject wrappers around `fd`.[^readme][^agents]

| DTO (extension) | Typical helpers |
|-----------------|-----------------|
| `CudaDevicePtr` | `cudaMalloc` / `cudaFree` / memcpy / memset; `cudaGL_map` / `cudaGL_launchPlasma` |
| `CudaHostPtr` | `cudaMallocHost` / `cudaFreeHost` |
| `CudaStream` | `cudaStreamCreate` / Destroy / Synchronize; optional arg to `cudaEventRecord` |
| `CudaEvent` | `cudaEventCreate` / Destroy / Record / Synchronize / ElapsedTime |
| `CudaGraphicsResource` | `cudaGL_registerBuffer` / unregister / map / unmap |

# Ownership

* Public `fd` is the opaque native pointer; **`0` means none / failed alloc**.[^readme]
* Failed `cudaMalloc` (and peers): DTO with `fd === 0`, then inspect `cudaGetLastError()` / `cudaGetErrorString()`.
* Do **not** invent a second ownership layer in this package — free with the matching helper (`cudaFree`, `cudaFreeHost`, stream/event destroy, or GL unregister/unmap).

# Enums vs DTOs

Enums under `Microscrap\Bindings\CUDA\Enums\` hold **int tokens** (errors, flags, memcpy kind docs). They are not DTOs. Some helpers accept `Enum|int` and unwrap `->value` before calling the extension (e.g. `cudaGetErrorString`, `cudaGL_registerBuffer`).[^runtime][^gl]

# See also

* [Helper naming](./helper-naming.md)
* [Do not cudaFree mapped GL ptr](../traps/do-not-cudafree-mapped-gl.md)

[^readme]: Package README
[^agents]: Agent guidelines
[^runtime]: Runtime helpers
[^gl]: GL interop helpers
