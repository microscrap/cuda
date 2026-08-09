---
type: Trap
title: Not cuda-gfx
description: Tubes framebuffer registration belongs in microscrap/cuda-gfx — not this package
tags: [cuda, traps, cuda-gfx, tubes]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
  - id: readme
    resource: ../README.md
    title: Package README
---

# Confusion

`microscrap/cuda` wraps Runtime + **CudaGL** helpers. **`microscrap/cuda-gfx`** is the reserved home for **tubes framebuffer registration** and related GFX wiring.[^agents][^readme]

# Do not

* Add tubes Framebuffer registration classes or ServiceProviders to this package
* Treat CudaGL helpers as a substitute for cuda-gfx registration
* Document cuda-gfx APIs inside this `.okf` as if they already shipped

# Correct split

| Need | Package |
|------|---------|
| `cuda*` / `cudaGL_*` helpers + enums | **`microscrap/cuda`** (here) |
| Tubes framebuffer / GFX registration | **`microscrap/cuda-gfx`** (future) |

[^agents]: Agent guidelines
[^readme]: Package README
