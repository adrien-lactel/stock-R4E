@echo off
echo === IMPORT SNES_GAMES VERS RAILWAY ===
echo.

REM Chercher PHP dans les chemins Laragon courants
set PHP_PATH=

if exist "C:\laragon\bin\php\php-8.2.0\php.exe" set PHP_PATH=C:\laragon\bin\php\php-8.2.0\php.exe
if exist "C:\laragon\bin\php\php-8.1.0\php.exe" set PHP_PATH=C:\laragon\bin\php\php-8.1.0\php.exe
if exist "C:\laragon\bin\php\php-8.0.0\php.exe" set PHP_PATH=C:\laragon\bin\php\php-8.0.0\php.exe
if exist "C:\laragon\bin\php\php-7.4.0\php.exe" set PHP_PATH=C:\laragon\bin\php\php-7.4.0\php.exe

REM Chercher dans bin/php directement
for /d %%i in ("C:\laragon\bin\php\php-*") do (
    if exist "%%i\php.exe" set PHP_PATH=%%i\php.exe
)

REM Si PHP n'est pas trouvé, chercher avec where
if "%PHP_PATH%"=="" (
    where php >nul 2>&1
    if %ERRORLEVEL% EQU 0 (
        set PHP_PATH=php
    )
)

if "%PHP_PATH%"=="" (
    echo ERREUR: PHP introuvable!
    echo.
    echo Veuillez demarrer Laragon ou verifier l'installation PHP
    pause
    exit /b 1
)

echo Utilisation de PHP: %PHP_PATH%
echo.

"%PHP_PATH%" import-snes-final.php

echo.
if %ERRORLEVEL% EQU 0 (
    echo =============================================
    echo IMPORT TERMINE AVEC SUCCES!
    echo =============================================
) else (
    echo ERREUR DURANT L'IMPORT
)
echo.
pause
