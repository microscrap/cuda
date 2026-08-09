<?php

namespace Microscrap\Bindings\CUDA\Enums;

/**
 * cudaEventCreateWithFlags values (for future create-with-flags surface).
 * Current ext-cuda exposes cudaEventCreate() (default event flags).
 */
enum CudaEventFlags: int
{
    case CUDA_EVENT_DEFAULT = 0;
    case CUDA_EVENT_BLOCKING_SYNC = 1;
    case CUDA_EVENT_DISABLE_TIMING = 2;
    case CUDA_EVENT_INTERPROCESS = 4;
}
