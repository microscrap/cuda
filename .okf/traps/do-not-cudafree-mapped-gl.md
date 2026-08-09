---
type: Trap
title: Do not cudaFree mapped GL ptr
description: Pointers from cudaGL_map are graphics-mapped — unmap/unregister, never cudaFree
tags: [cuda, traps, gl, ownership]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: gl
    resource: ../src/Helpers/cuda-gl.php
    title: GL interop helpers
  - id: readme
    resource: ../README.md
    title: Package README
---

# Symptom

Calling `cudaFree()` on a `CudaDevicePtr` returned by `cudaGL_map()` can corrupt GL/CUDA interop state or crash. That pointer is **mapped graphics memory**, not a Runtime `cudaMalloc` allocation.[^gl]

# Correct lifecycle

```text
cudaGL_registerBuffer(pbo) → CudaGraphicsResource
cudaGL_map(res)            → CudaDevicePtr (do not cudaFree)
  … kernel / writes …
cudaGL_unmap(res)
cudaGL_unregister(res)
```

README’s GPU-owned framebuffer sketch follows register → map → launch → unmap → present.[^readme]

# Rule of thumb

| How you got the `CudaDevicePtr` | How you release it |
|---------------------------------|--------------------|
| `cudaMalloc` | `cudaFree` |
| `cudaGL_map` | `cudaGL_unmap` (+ later `cudaGL_unregister` on the resource) |

[^gl]: GL interop helpers
[^readme]: Package README
