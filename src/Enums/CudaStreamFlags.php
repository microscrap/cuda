<?php

namespace Microscrap\Bindings\CUDA\Enums;

/**
 * cudaStreamCreateWithFlags values (for future create-with-flags surface).
 * Current ext-cuda exposes cudaStreamCreate() (default stream flags).
 */
enum CudaStreamFlags: int
{
    case CUDA_STREAM_DEFAULT = 0;
    case CUDA_STREAM_NON_BLOCKING = 1;
}
