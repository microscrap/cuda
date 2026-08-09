<?php

namespace DeptOfScrapyardRobotics\Tests\Unit;

/**
 * Style contract audit for src/:
 * no class constants, no throw statements, every helper guarded by
 * function_exists, every enum backed, enum cases FULLY UPPERCASE.
 */
function cudaSrcFiles(?string $subdir = null): array
{
    $root = dirname(__DIR__, 2).'/src'.(is_null($subdir) ? '' : "/{$subdir}");
    $files = [];

    $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $files[] = $file->getPathname();
        }
    }
    sort($files);

    return $files;
}

it('declares no class constants anywhere in src/', function (): void {
    foreach (cudaSrcFiles() as $file) {
        $tokens = \PhpToken::tokenize(file_get_contents($file));
        foreach ($tokens as $token) {
            expect($token->id)->not->toBe(T_CONST, "Class constant found in {$file} on line {$token->line}");
        }
    }
});

it('throws no exceptions anywhere in src/', function (): void {
    foreach (cudaSrcFiles() as $file) {
        $tokens = \PhpToken::tokenize(file_get_contents($file));
        foreach ($tokens as $token) {
            expect($token->id)->not->toBe(T_THROW, "throw statement found in {$file} on line {$token->line}");
        }
    }
});

it('guards every helper function with function_exists', function (): void {
    foreach (cudaSrcFiles('Helpers') as $file) {
        $tokens = array_values(array_filter(
            \PhpToken::tokenize(file_get_contents($file)),
            fn (\PhpToken $t) => ! $t->isIgnorable()
        ));

        foreach ($tokens as $i => $token) {
            if ($token->id !== T_FUNCTION) {
                continue;
            }

            $guarded = false;
            for ($j = $i - 1; $j >= max(0, $i - 12); $j--) {
                if ($tokens[$j]->id === T_STRING && $tokens[$j]->text === 'function_exists') {
                    $guarded = true;
                    break;
                }
            }

            expect($guarded)->toBeTrue("Unguarded function in {$file} on line {$token->line}");
        }
    }
});

it('backs every enum with int or string', function (): void {
    foreach (cudaSrcFiles('Enums') as $file) {
        $source = file_get_contents($file);
        expect($source)->toMatch(
            '/enum\s+\w+\s*:\s*(int|string)/',
            "Unbacked enum in {$file}"
        );
    }
});

it('uses FULLY UPPERCASE enum case names', function (): void {
    foreach (cudaSrcFiles('Enums') as $file) {
        if (! preg_match_all('/\bcase\s+([A-Za-z_][A-Za-z0-9_]*)\s*=/', file_get_contents($file), $matches)) {
            continue;
        }

        foreach ($matches[1] as $caseName) {
            expect($caseName)->toBe(strtoupper($caseName), "Non-UPPERCASE enum case {$caseName} in {$file}");
        }
    }
});
