---
type: Orientation
title: Stack vs ext-cuda vs cuda-gfx
description: Composition boundaries between this helpers package, the native extension, and future tubes GFX
tags: [cuda, microscrap, orientation, boundaries]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: readme
    resource: ../README.md
    title: Package README
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
  - id: composer
    resource: ../composer.json
    title: Package composer.json (0.7.0)
---

# Three layers

```text
App / tubes / demos
  ├─ microscrap/cuda          ← THIS package (PHP helpers + enums)
  │     requires ext-cuda ^0.7.0
  ├─ php-io-extensions/cuda   ← native PHP extension (Cuda / CudaGL)
  └─ microscrap/cuda-gfx      ← FUTURE tubes framebuffer registration (not here)
```

| Package | Role | Ships |
|---------|------|-------|
| `php-io-extensions/cuda` | Native **ext-cuda** | `Cuda\Cuda\Cuda`, `CudaGL`, DTOs, embedded plasma PTX |
| **`microscrap/cuda`** | Helpers + enums over ext-cuda | Global `cuda*` / `cudaGL_*`, backed Enums |
| `microscrap/cuda-gfx` | Tubes GFX registration (deferred) | **Not** in this tree; do not invent APIs here[^agents] |

# Composition for a GPU-owned framebuffer demo

```text
PHP app (typically Jetson / Ubuntu / WSL)
  ├─ sdl3 or glfw     → window + GL context + poll + Quit
  ├─ open-gl (optional) → full gl* if needed beyond present helpers
  └─ microscrap/cuda  → cuda* Runtime + cudaGL_* interop/present
        └─ ext-cuda   → native Cuda / CudaGL
```

CudaGL **lives in the extension and is wrapped here**. Tubes framebuffer registration is explicitly deferred to **`microscrap/cuda-gfx`**.[^readme][^agents]

# Hard boundaries for agents

1. Document and change **helpers/enums** in this package only.
2. Extension build, Zephir, PIE, and `.so` linking knowledge belong with **php-io-extensions/cuda**.
3. Do **not** add ServiceProviders, Framebuffer classes, or tubes registration surfaces here — that is **cuda-gfx**.
4. Windowing stays in sdl3/glfw; do not pull those into this package’s runtime requires.[^composer]

[^readme]: Package README
[^agents]: Agent guidelines
[^composer]: Package composer.json (0.7.0)
