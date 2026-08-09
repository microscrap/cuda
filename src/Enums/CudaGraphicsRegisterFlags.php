<?php

namespace Microscrap\Bindings\CUDA\Enums;

/**
 * Flags for cudaGraphicsGLRegisterBuffer / CudaGL::registerBuffer.
 */
enum CudaGraphicsRegisterFlags: int
{
    case CUDA_GRAPHICS_REGISTER_FLAGS_NONE = 0;
    case CUDA_GRAPHICS_REGISTER_FLAGS_READ_ONLY = 1;
    case CUDA_GRAPHICS_REGISTER_FLAGS_WRITE_DISCARD = 2;
    case CUDA_GRAPHICS_REGISTER_FLAGS_SURFACE_LOAD_STORE = 4;
    case CUDA_GRAPHICS_REGISTER_FLAGS_TEXTURE_GATHER = 8;
}
