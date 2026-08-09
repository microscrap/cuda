---
type: Convention
title: Enums FULLY UPPERCASE
description: Backed int enums under Enums\; FULLY UPPERCASE cases; no class constants
tags: [cuda, conventions, enums]
status: draft
resource: ../src/Enums/
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: style
    resource: ../tests/Unit/StyleAuditTest.php
    title: StyleAudit Pest tests
  - id: agents
    resource: ../AGENTS.md
    title: Agent guidelines
  - id: memcpy
    resource: ../src/Enums/CudaMemcpyKind.php
    title: CudaMemcpyKind enum
---

# Rules

* **No** PHP class-level `const` anywhere in `src/` — StyleAudit tokenizes and rejects `T_CONST`.[^style][^agents]
* Every enum is **backed** (`: int` or `: string`). This package’s enums are **int**-backed.[^style]
* Enum **case** names are **FULLY UPPERCASE** (e.g. `CUDA_SUCCESS`).[^style]

# Enum inventory (0.7.0)

| Enum | Role |
|------|------|
| `CudaError` | `cudaError_t` tokens; success is `CUDA_SUCCESS = 0` |
| `CudaMemcpyKind` | Documented memcpy directions; ext-cuda uses dedicated HtoD/DtoH/DtoD helpers instead of a kind arg[^memcpy] |
| `CudaGraphicsRegisterFlags` | Flags for `cudaGL_registerBuffer` |
| `CudaStreamFlags` | Stream create-with-flags tokens |
| `CudaEventFlags` | Event create-with-flags tokens |

# Usage with helpers

Helpers that accept tokens typically take `Enum|int` and unwrap `->value` before calling the extension. Status checks compare against `CudaError::CUDA_SUCCESS->value` (`0`).

[^style]: StyleAudit Pest tests
[^agents]: Agent guidelines
[^memcpy]: CudaMemcpyKind enum
