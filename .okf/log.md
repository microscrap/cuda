# Directory Update Log

## 2026-08-09

* **Update**: README badges + top prod docs link (`scrapyard-io.projectsaturnstudios.com/.../microscrap/cuda/0.7.x/overview`); `composer.json` `support.docs` / GitHub source; GitHub Actions Pest CI (PHP 8.4/8.5, `--ignore-platform-req=ext-cuda`) + Dependabot.
* **Update**: Expanded bundle to published-package quality for `microscrap/cuda` **0.7.0** (OKF v0.2). Added orientation stack segmentation; architecture helper-naming + DTO passthrough; conventions helpers-only + enums UPPERCASE; traps (mapped GL free, ext-cuda required, not CudaGraphics, not cuda-gfx); playbooks (composer verify, Jetson smoke); directory `index.md` files; richer root index. All new/updated concepts remain `status: draft` pending human verification.
* **Creation**: `microscrap/cuda` **0.7.0** helpers-only bindings over `ext-cuda` (posix/ftdi pattern). Runtime helpers = exact CUDA names; GL helpers = `cudaGL_*`; enums for error/memcpy/graphics/stream/event; DTO passthrough; StyleAudit + helper coverage tests. CudaGL lives here; `cuda-gfx` reserved for tubes framebuffer registration.
