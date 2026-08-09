---
type: Convention
title: No exceptions / C-style
description: Bindings stay C-shaped; status ints; function_exists guards; DTO passthrough
tags: [cuda, conventions]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: style
    resource: ../tests/Unit/StyleAuditTest.php
    title: StyleAudit Pest tests
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
  - id: readme
    resource: ../README.md
    title: Package README
  - id: gl
    resource: ../src/Helpers/cuda-gl.php
    title: GL interop helpers
---

# Rules

* **No** `throw` in `src/` — StyleAudit rejects `T_THROW`.[^style][^agents]
* Status returns are `int`; success is `CudaError::CUDA_SUCCESS->value` (`0`).[^readme]
* Failed allocs: DTO with `fd === 0`; then `cudaGetLastError()` / `cudaGetErrorString()`.[^readme]
* Every helper wrapped in a `function_exists` guard.[^style]
* Prefer `is_null($x)` over `$x === null` in new PHP when touching null checks.[^agents]
* Never `cudaFree()` a device pointer from `cudaGL_map()` — only `cudaGL_unmap()` / `cudaGL_unregister()`.[^gl]

# Related conventions

* [Helpers-only](./helpers-only.md)
* [Enums FULLY UPPERCASE](./enums-uppercase.md)

[^style]: StyleAudit Pest tests
[^agents]: Agent guidelines
[^readme]: Package README
[^gl]: GL interop helpers
