---
type: Convention
title: Helpers-only (posix / ftdi)
description: Global helpers over extension statics — no ServiceProvider, no facade classes
tags: [cuda, conventions, helpers]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
  - id: composer
    resource: ../composer.json
    title: Package composer.json (0.7.0)
  - id: readme
    resource: ../README.md
    title: Package README
---

# Model

Same tier as **posix / ftdi**:

* Composer `"files"` autoload loads helper PHP files.[^composer]
* Each helper is a **global function** guarded by `function_exists`.
* Bodies call `Cuda\Cuda\Cuda::…` or `Cuda\Cuda\CudaGL::…` directly.
* PSR-4 namespace is for **Enums** under `Microscrap\Bindings\CUDA\` only — not Runtime/GL facades.[^agents]

# Do not add

* Laravel / tubes **ServiceProviders**
* Microscrap facade / wrapper **classes** over Runtime or GL
* DataObject re-wraps of extension DTOs
* Unpublished APIs that belong in `microscrap/cuda-gfx`

# Autoload

```json
"autoload": {
  "psr-4": { "Microscrap\\Bindings\\CUDA\\": "src/" },
  "files": [
    "src/Helpers/cuda-runtime.php",
    "src/Helpers/cuda-gl.php"
  ]
}
```

[^agents]: Agent guidelines
[^composer]: Package composer.json (0.7.0)
[^readme]: Package README
