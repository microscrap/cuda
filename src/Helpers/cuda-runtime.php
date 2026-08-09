<?php

use Cuda\Cuda\Cuda;
use Cuda\Cuda\CudaDevicePtr;
use Cuda\Cuda\CudaEvent;
use Cuda\Cuda\CudaHostPtr;
use Cuda\Cuda\CudaStream;
use Microscrap\Bindings\CUDA\Enums\CudaError;

/*
|--------------------------------------------------------------------------
| CUDA Runtime helpers — 1:1 over ext-cuda (Cuda\Cuda\Cuda)
|--------------------------------------------------------------------------
| Helper names match the CUDA Runtime / extension method names (cudaMalloc).
| Extension DTOs (CudaDevicePtr, …) are passed through unchanged.
*/

if (! function_exists('cudaGetDeviceCount')) {
    function cudaGetDeviceCount(): int
    {
        return Cuda::cudaGetDeviceCount();
    }
}

if (! function_exists('cudaSetDevice')) {
    function cudaSetDevice(int $device): int
    {
        return Cuda::cudaSetDevice($device);
    }
}

if (! function_exists('cudaGetDevice')) {
    function cudaGetDevice(): int
    {
        return Cuda::cudaGetDevice();
    }
}

if (! function_exists('cudaGetDeviceProperties')) {
    /**
     * @return array<string, mixed>
     */
    function cudaGetDeviceProperties(int $device): array
    {
        return Cuda::cudaGetDeviceProperties($device);
    }
}

if (! function_exists('cudaDeviceSynchronize')) {
    function cudaDeviceSynchronize(): int
    {
        return Cuda::cudaDeviceSynchronize();
    }
}

if (! function_exists('cudaDeviceReset')) {
    function cudaDeviceReset(): int
    {
        return Cuda::cudaDeviceReset();
    }
}

if (! function_exists('cudaGetLastError')) {
    function cudaGetLastError(): int
    {
        return Cuda::cudaGetLastError();
    }
}

if (! function_exists('cudaPeekAtLastError')) {
    function cudaPeekAtLastError(): int
    {
        return Cuda::cudaPeekAtLastError();
    }
}

if (! function_exists('cudaGetErrorString')) {
    function cudaGetErrorString(CudaError|int $error): string
    {
        return Cuda::cudaGetErrorString($error instanceof CudaError ? $error->value : $error);
    }
}

if (! function_exists('cudaGetErrorName')) {
    function cudaGetErrorName(CudaError|int $error): string
    {
        return Cuda::cudaGetErrorName($error instanceof CudaError ? $error->value : $error);
    }
}

if (! function_exists('cudaMalloc')) {
    function cudaMalloc(int $size): CudaDevicePtr
    {
        return Cuda::cudaMalloc($size);
    }
}

if (! function_exists('cudaFree')) {
    function cudaFree(CudaDevicePtr $ptr): int
    {
        return Cuda::cudaFree($ptr);
    }
}

if (! function_exists('cudaMallocHost')) {
    function cudaMallocHost(int $size): CudaHostPtr
    {
        return Cuda::cudaMallocHost($size);
    }
}

if (! function_exists('cudaFreeHost')) {
    function cudaFreeHost(CudaHostPtr $ptr): int
    {
        return Cuda::cudaFreeHost($ptr);
    }
}

if (! function_exists('cudaMemcpyHtoD')) {
    function cudaMemcpyHtoD(CudaDevicePtr $dst, string $src, int $count): int
    {
        return Cuda::cudaMemcpyHtoD($dst, $src, $count);
    }
}

if (! function_exists('cudaMemcpyDtoH')) {
    function cudaMemcpyDtoH(CudaDevicePtr $src, int $count): string
    {
        return Cuda::cudaMemcpyDtoH($src, $count);
    }
}

if (! function_exists('cudaMemcpyDtoD')) {
    function cudaMemcpyDtoD(CudaDevicePtr $dst, CudaDevicePtr $src, int $count): int
    {
        return Cuda::cudaMemcpyDtoD($dst, $src, $count);
    }
}

if (! function_exists('cudaMemset')) {
    function cudaMemset(CudaDevicePtr $dst, int $value, int $count): int
    {
        return Cuda::cudaMemset($dst, $value, $count);
    }
}

if (! function_exists('cudaStreamCreate')) {
    function cudaStreamCreate(): CudaStream
    {
        return Cuda::cudaStreamCreate();
    }
}

if (! function_exists('cudaStreamDestroy')) {
    function cudaStreamDestroy(CudaStream $stream): int
    {
        return Cuda::cudaStreamDestroy($stream);
    }
}

if (! function_exists('cudaStreamSynchronize')) {
    function cudaStreamSynchronize(CudaStream $stream): int
    {
        return Cuda::cudaStreamSynchronize($stream);
    }
}

if (! function_exists('cudaEventCreate')) {
    function cudaEventCreate(): CudaEvent
    {
        return Cuda::cudaEventCreate();
    }
}

if (! function_exists('cudaEventDestroy')) {
    function cudaEventDestroy(CudaEvent $event): int
    {
        return Cuda::cudaEventDestroy($event);
    }
}

if (! function_exists('cudaEventRecord')) {
    function cudaEventRecord(CudaEvent $event, ?CudaStream $stream = null): int
    {
        return Cuda::cudaEventRecord($event, $stream);
    }
}

if (! function_exists('cudaEventSynchronize')) {
    function cudaEventSynchronize(CudaEvent $event): int
    {
        return Cuda::cudaEventSynchronize($event);
    }
}

if (! function_exists('cudaEventElapsedTime')) {
    function cudaEventElapsedTime(CudaEvent $start, CudaEvent $end): float
    {
        return Cuda::cudaEventElapsedTime($start, $end);
    }
}
