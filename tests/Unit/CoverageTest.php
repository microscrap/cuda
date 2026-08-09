<?php

namespace DeptOfScrapyardRobotics\Tests\Unit;

/**
 * Ensures every ext-cuda 0.7.0 static on Cuda / CudaGL has a microscrap helper.
 */
function helperFunctionNames(string $relativePath): array
{
    $source = file_get_contents(dirname(__DIR__, 2).'/'.$relativePath);
    preg_match_all("/function_exists\\('([^']+)'\\)/", $source, $matches);

    return $matches[1];
}

it('wraps every Cuda Runtime method with an identically named helper', function (): void {
    $map = require dirname(__DIR__).'/Support/extension-methods-0.7.0.php';
    $helpers = helperFunctionNames('src/Helpers/cuda-runtime.php');

    foreach ($map['runtime'] as $method) {
        expect(in_array($method, $helpers, true))->toBeTrue("Missing Runtime helper for {$method}");
    }

    expect($helpers)->toHaveCount(count($map['runtime']));
});

it('wraps every CudaGL method with a cudaGL_* helper', function (): void {
    $map = require dirname(__DIR__).'/Support/extension-methods-0.7.0.php';
    $helpers = helperFunctionNames('src/Helpers/cuda-gl.php');

    foreach ($map['gl'] as $method) {
        $expected = 'cudaGL_'.$method;
        expect(in_array($expected, $helpers, true))->toBeTrue(
            "Missing GL helper for {$method} (expected {$expected})"
        );
    }

    expect($helpers)->toHaveCount(count($map['gl']));
});

it('optionally mirrors live extension reflection when ext-cuda is loaded', function (): void {
    if (! extension_loaded('cuda')) {
        expect(true)->toBeTrue();

        return;
    }

    $map = require dirname(__DIR__).'/Support/extension-methods-0.7.0.php';

    $runtime = new \ReflectionClass(\Cuda\Cuda\Cuda::class);
    $liveRuntime = [];
    foreach ($runtime->getMethods(\ReflectionMethod::IS_STATIC | \ReflectionMethod::IS_PUBLIC) as $method) {
        if ($method->getDeclaringClass()->getName() === \Cuda\Cuda\Cuda::class) {
            $liveRuntime[] = $method->getName();
        }
    }
    sort($liveRuntime);
    $expected = $map['runtime'];
    sort($expected);
    expect($liveRuntime)->toBe($expected);

    $gl = new \ReflectionClass(\Cuda\Cuda\CudaGL::class);
    $liveGl = [];
    foreach ($gl->getMethods(\ReflectionMethod::IS_STATIC | \ReflectionMethod::IS_PUBLIC) as $method) {
        if ($method->getDeclaringClass()->getName() === \Cuda\Cuda\CudaGL::class) {
            $liveGl[] = $method->getName();
        }
    }
    sort($liveGl);
    $expectedGl = $map['gl'];
    sort($expectedGl);
    expect($liveGl)->toBe($expectedGl);
});
