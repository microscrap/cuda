---
okf_version: "0.2"
---

# microscrap/cuda Knowledge Bundle

Package knowledge for `microscrap/cuda` (CUDA Runtime + CudaGL helpers over **ext-cuda**, v0.7.0).
Read this index first; open only the concepts needed for the task.

**Trust rule:** Prefer `status: stable`. Treat `deprecated` as historical only. New agent-written concepts stay `status: draft` until a human verifies them.
**Placement:** This bundle lives at the **package root** only — never under `src/`.
**Links:** Concept cross-links use paths relative to each file.
**Scope:** Document the helpers-only bindings package. Do **not** invent ServiceProviders or tubes Framebuffer registration here — those belong in `microscrap/cuda-gfx` / tubes. Extension build knowledge belongs with `php-io-extensions/cuda`.
**Dist note:** `.okf/` and root `AGENTS.md` are `export-ignore` in `.gitattributes` so Composer dist packages do not ship this bundle.
**Docs:** [Ecosystem overview (prod)](https://scrapyard-io.projectsaturnstudios.com/ecosystem/microscrap/cuda/0.7.x/overview)

# Orientation

* [Package (0.7)](orientation/package.md) - Composer identity, helpers-only wrap model, and public surface
* [Stack vs ext-cuda vs cuda-gfx](orientation/stack-vs-ext.md) - Composition boundaries across the CUDA PHP stack

# Architecture

* [Helper naming](architecture/helper-naming.md) - Exact CUDA names for Runtime; `cudaGL_*` for interop
* [DTO passthrough](architecture/dto-passthrough.md) - Extension DTOs pass through; no DataObject re-wrap

# Conventions

* [Helpers-only (posix / ftdi)](conventions/helpers-only.md) - Global helpers over extension statics; no ServiceProvider/facades
* [No exceptions / C-style](conventions/no-exceptions-c-style.md) - Status ints; function_exists; no throw in src/
* [Enums FULLY UPPERCASE](conventions/enums-uppercase.md) - Backed int enums; no class constants

# Traps

* [Do not cudaFree mapped GL ptr](traps/do-not-cudafree-mapped-gl.md) - Map/unmap ownership vs Runtime cudaFree
* [ext-cuda required](traps/ext-cuda-required.md) - Helpers need the native extension loaded
* [Not CudaGraphics](traps/not-cudagraphics.md) - No high-level CudaGraphics product API here
* [Not cuda-gfx](traps/not-cuda-gfx.md) - Tubes framebuffer registration is a different package

# Playbooks

* [Composer require and verify helpers](playbooks/composer-require-verify.md) - Install package and confirm helper autoload + Pest audits
* [Jetson smoke with ext-cuda](playbooks/jetson-smoke.md) - Minimal Runtime alloc/memcpy smoke on device

# Indexes

* [Orientation](orientation/) — start here
* [Architecture](architecture/)
* [Conventions](conventions/)
* [Traps](traps/)
* [Playbooks](playbooks/)

# Log

* [Directory update log](log.md)
