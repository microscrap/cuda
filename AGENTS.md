# Agent guidelines — microscrap/cuda

## Knowledge Bundle (OKF)

This package ships an Open Knowledge Format bundle at [`.okf/`](.okf/) (excluded from Composer dist via `.gitattributes` `export-ignore`).

Before changing bindings code or advising on CUDA PHP wrappers **for this package**:

1. Read [`.okf/index.md`](.okf/index.md) first (progressive disclosure).
2. Open only the linked concepts needed for the task (use subdirectory indexes under `.okf/orientation/`, `architecture/`, `conventions/`, `traps/`, `playbooks/`).
3. Prefer `status: stable` concepts; treat `deprecated` as historical only. New/changed concepts stay `status: draft` until a human verifies them.
4. When you learn something durable about **this package**, update the affected `.okf` concept(s) and append `.okf/log.md`.
5. Keep the `.okf` bundle at the **package root** only — do not nest extra `.okf` folders under `src/`.
6. Tubes framebuffer / GFX registration belongs in `microscrap/cuda-gfx`. Extension build knowledge belongs with `php-io-extensions/cuda`.

## Package rules (quick) — 0.7.x

- Composer: `microscrap/cuda` **0.7.0**. PHP `^8.4|^8.5|^8.6`. Requires `ext-cuda` `^0.7.0`.
- Namespace: `Microscrap\Bindings\CUDA\` → `src/` (Enums only; helpers are global functions).
- **Helpers-only** (posix / ftdi style) — no ServiceProvider, no facade classes over Runtime/GL.
- Runtime helpers use exact CUDA / extension names (`cudaMalloc`). GL helpers use `cudaGL_*`.
- Extension DTOs (`Cuda\Cuda\*`) are passed through; do not re-wrap `fd`.
- No exceptions in `src/`; C-style status ints + `cudaGetErrorString()`.
- Enums are backed (int); cases **FULLY UPPERCASE**; no PHP class-level constants.
- Do not conflate with `php-io-extensions/cuda` (native extension) or `microscrap/cuda-gfx` (tubes).
- Never `cudaFree()` a device pointer from `cudaGL_map()` — only `cudaGL_unmap()` / `cudaGL_unregister()`.
- Ecosystem docs: https://scrapyard-io.projectsaturnstudios.com/ecosystem/microscrap/cuda/0.7.x/overview
