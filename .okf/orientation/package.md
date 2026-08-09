---
type: Orientation
title: Package (0.7)
description: Composer identity, helpers-only wrap model, and public surface of microscrap/cuda
tags: [cuda, microscrap, bindings, orientation]
status: draft
resource: ../composer.json
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: composer
    resource: ../composer.json
    title: Package composer.json (0.7.0)
  - id: readme
    resource: ../README.md
    title: Package README
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
  - id: gitattributes
    resource: ../.gitattributes
    title: Dist export-ignore rules
  - id: ecosystem
    resource: https://scrapyard-io.projectsaturnstudios.com/ecosystem/microscrap/cuda/0.7.x/overview
    title: Ecosystem docs (prod)
---

# Identity

| Field | Value |
|-------|--------|
| Composer | `microscrap/cuda` **0.7.0**[^composer] |
| PHP | `^8.4\|^8.5\|^8.6`[^composer] |
| Requires | `ext-cuda` `^0.7.0`[^composer] |
| Homepage | Ecosystem overview (prod)[^ecosystem] |
| Namespace | `Microscrap\Bindings\CUDA\` → `src/` (Enums only)[^agents] |
| Helpers (autoload files) | `src/Helpers/cuda-runtime.php`, `src/Helpers/cuda-gl.php`[^composer] |
| License | MIT |

# What this package is

A **helpers-only** PHP bindings package over the native **ext-cuda** extension (`php-io-extensions/cuda`), in the same tier as **posix / ftdi**: global functions call extension statics directly. There are **no** ServiceProviders, **no** facade classes over Runtime/GL, and **no** DataObject re-wrap of extension DTOs.[^readme][^agents]

| Surface | Helper style | Extension class |
|---------|--------------|-----------------|
| Runtime | Exact CUDA / ext names (`cudaMalloc`, …) | `Cuda\Cuda\Cuda` |
| Interop / present | Prefixed `cudaGL_*` | `Cuda\Cuda\CudaGL` |

Enums live under `Microscrap\Bindings\CUDA\Enums\`. Extension DTOs (`CudaDevicePtr`, `CudaHostPtr`, `CudaStream`, `CudaEvent`, `CudaGraphicsResource`) are returned and accepted **as-is**; public `fd` ownership is unchanged (`0` = none).[^readme]

# What this package is not

| Concern | Belongs elsewhere |
|---------|-------------------|
| Native extension build / Zephir / PIE | `php-io-extensions/cuda` |
| Tubes framebuffer / GFX registration | `microscrap/cuda-gfx` (future; not this package) |
| Window / Quit UX | `sdl3` / `glfw` peers |
| Full OpenGL `gl*` draw API | `open-gl` peer |
| High-level CudaGraphics product API | Prior art — do not reimplement here |

# Dist packaging

`.okf/` and root `AGENTS.md` are listed in `.gitattributes` as `export-ignore`, so Composer **dist** packages do not ship this knowledge bundle.[^gitattributes]

# See also

* [Stack vs ext-cuda vs cuda-gfx](./stack-vs-ext.md)
* [Helpers-only convention](../conventions/helpers-only.md)
* Ecosystem overview[^ecosystem]

[^composer]: Package composer.json (0.7.0)
[^readme]: Package README
[^agents]: Agent guidelines
[^gitattributes]: Dist export-ignore rules
[^ecosystem]: Ecosystem docs (prod)
