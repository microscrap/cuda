---
type: Trap
title: ext-cuda required
description: This package is helpers only — without the cuda PHP extension, helpers cannot run
tags: [cuda, traps, extension, pie]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: composer
    resource: ../composer.json
    title: Package composer.json (0.7.0)
  - id: readme
    resource: ../README.md
    title: Package README
---

# Symptom

`composer require microscrap/cuda` alone is insufficient on a host without **ext-cuda**. Composer declares `"ext-cuda": "^0.7.0"`; helpers call `Cuda\Cuda\Cuda` / `CudaGL` classes that exist only when the extension is loaded.[^composer]

# Fix

1. Install the native extension (PIE example from README):[^readme]

```bash
export CUDA_HOME=/usr/local/cuda
pie install php-io-extensions/cuda:0.7.x-dev
php -m | grep cuda
```

2. Then require the helpers package:

```bash
composer require microscrap/cuda
```

# Notes

* Pest StyleAudit / Coverage can run without a GPU, but live reflection coverage and real Runtime calls need the extension loaded.
* Extension build/install knowledge lives with **php-io-extensions/cuda**, not this OKF.

[^composer]: Package composer.json (0.7.0)
[^readme]: Package README
