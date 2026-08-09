<?php

namespace Microscrap\Bindings\CUDA\Enums;

/**
 * cudaMemcpyKind — documented for completeness.
 * ext-cuda exposes dedicated HtoD / DtoH / DtoD helpers instead of a kind arg.
 */
enum CudaMemcpyKind: int
{
    case CUDA_MEMCPY_HOST_TO_HOST = 0;
    case CUDA_MEMCPY_HOST_TO_DEVICE = 1;
    case CUDA_MEMCPY_DEVICE_TO_HOST = 2;
    case CUDA_MEMCPY_DEVICE_TO_DEVICE = 3;
    case CUDA_MEMCPY_DEFAULT = 4;
}
