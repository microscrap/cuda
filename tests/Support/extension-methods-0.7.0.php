<?php

/**
 * Frozen ext-cuda 0.7.0 public static surfaces that microscrap/cuda must wrap.
 *
 * @return array{runtime: list<string>, gl: list<string>}
 */
return [
    'runtime' => [
        'cudaGetDeviceCount',
        'cudaSetDevice',
        'cudaGetDevice',
        'cudaGetDeviceProperties',
        'cudaDeviceSynchronize',
        'cudaDeviceReset',
        'cudaGetLastError',
        'cudaPeekAtLastError',
        'cudaGetErrorString',
        'cudaGetErrorName',
        'cudaMalloc',
        'cudaFree',
        'cudaMallocHost',
        'cudaFreeHost',
        'cudaMemcpyHtoD',
        'cudaMemcpyDtoH',
        'cudaMemcpyDtoD',
        'cudaMemset',
        'cudaStreamCreate',
        'cudaStreamDestroy',
        'cudaStreamSynchronize',
        'cudaEventCreate',
        'cudaEventDestroy',
        'cudaEventRecord',
        'cudaEventSynchronize',
        'cudaEventElapsedTime',
    ],
    'gl' => [
        'createPixelUnpackBuffer',
        'deleteBuffer',
        'createTextureRGBA',
        'deleteTexture',
        'registerBuffer',
        'unregister',
        'map',
        'unmap',
        'launchPlasma',
        'launchClear',
        'launchFillRect',
        'launchWritePixel',
        'uploadPBOToTexture',
        'clear',
        'drawFullscreenTexture',
        'fillRect',
    ],
];
