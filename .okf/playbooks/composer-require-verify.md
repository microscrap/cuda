---
type: Playbook
title: Composer require and verify helpers
description: Install microscrap/cuda and confirm Runtime/GL helpers autoload against the coverage map
tags: [cuda, playbooks, composer, pest]
status: draft
generated: { by: okf-documentation-generator/cursor, at: 2026-08-09T02:20:00Z }
sources:
  - id: readme
    resource: ../README.md
    title: Package README
  - id: composer
    resource: ../composer.json
    title: Package composer.json (0.7.0)
  - id: coverage
    resource: ../tests/Unit/CoverageTest.php
    title: Helper coverage Pest tests
  - id: style
    resource: ../tests/Unit/StyleAuditTest.php
    title: StyleAudit Pest tests
---

# Prerequisites

* PHP `^8.4|^8.5|^8.6`
* **ext-cuda** `^0.7.0` installed and visible to `php -m`[^readme]
* Composer

# Steps

1. Confirm the extension:

```bash
php -m | grep cuda
```

2. Require the package (app or monorepo path as appropriate):[^readme]

```bash
composer require microscrap/cuda
```

3. Smoke that helpers exist after autoload:

```bash
php -r 'require "vendor/autoload.php"; var_export(function_exists("cudaMalloc") && function_exists("cudaGL_map"));'
```

Expect `true`.

4. In this package’s checkout, run Pest style + coverage (no GPU required for StyleAudit / frozen-map Coverage):

```bash
./vendor/bin/pest
```

Coverage asserts every frozen ext-cuda 0.7.0 Runtime/GL method has a matching helper.[^coverage] StyleAudit enforces no `throw`/`const`, `function_exists` guards, backed UPPERCASE enums.[^style]

# Success criteria

* `ext-cuda` loaded (or Composer platform config acknowledges it)
* `cudaMalloc` and `cudaGL_*` helpers autoload
* Pest StyleAudit + Coverage green in package checkout

# See also

* [Jetson smoke with ext-cuda](./jetson-smoke.md)
* [ext-cuda required](../traps/ext-cuda-required.md)

[^readme]: Package README
[^composer]: Package composer.json (0.7.0)
[^coverage]: Helper coverage Pest tests
[^style]: StyleAudit Pest tests
