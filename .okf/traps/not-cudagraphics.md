---
type: Trap
title: Not CudaGraphics
description: Do not port projectsaturnstudios/CudaGraphics-PHP high-level APIs into this helpers package
tags: [cuda, traps, boundaries]
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

`projectsaturnstudios/CudaGraphics-PHP` (and similarly named high-level draw/particle product APIs) are **prior art**, not the public surface of `microscrap/cuda`.

# This package’s surface

* C-ish Runtime helpers (`cudaMalloc`, …)
* `cudaGL_*` interop / present helpers over extension `CudaGL` (including shipped plasma launch)
* Backed enums for errors / flags

# Do not

* Reimplement CudaGraphics class hierarchies or product draw APIs here
* Invent ServiceProviders or facade layers “to match CudaGraphics”
* Document unpublished high-level APIs as if they shipped in 0.7.0

Windowing and full `gl*` remain peer packages; see [stack segmentation](../orientation/stack-vs-ext.md).[^agents][^readme]

[^agents]: Agent guidelines
[^readme]: Package README
