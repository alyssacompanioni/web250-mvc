<?php

/**
 *  declare(strict_types=1); turns on strict type checking for this file:
 *  PHP will reject calls where argument or return types don’t exactly
 *  match the declared types (no implicit coercion from, say, 
 * string to int). It helps catch type mistakes earlier.
 */

declare(strict_types=1);

/**
 *  namespace Web250\Mvc; This line declares a PHP namespace so this class lives
 *  under Web250\Mvc. 
 * 
 *  Namespacing prevents name collisions and lets you refer
 *  to the class with Web250\Mvc\Database (or import it via use
 *  Web250\Mvc\Database;). Without it, Database would sit in
 *  the global namespace and could conflict with other
 *  classes. It should match how you reference it
 *  elsewhere; in Salamander.php we 
 *  use Web250\Mvc\Database so
 *  the names align.
 * 
 */

namespace Web250\Mvc;

/**
 *  Use PDO imports PHP’s built‑in PDO class into the current namespace so you
 *  can reference it simply as PDO instead of the fully qualified \PDO.
 *  This avoids long class names and keeps references consistent
 *  within Web250\Mvc\Database.
 */

use PDO;
use PDOException;

/**
 * Database
 *
 * A tiny helper class that:
 *  - reads credentials from config/db_credentials.php
 *  - creates a PDO connection
 *  - reuses (caches) that connection for the rest of the request
 *
 * Usage in a model:
 *
 *   use Web250\Mvc\Database;
 *
 *   $pdo = Database::getConnection();
 *   $stmt = $pdo->query('SELECT * FROM salamanders');
 *   $rows = $stmt->fetchAll();
 */

class Database
{
    /**
     * A single shared PDO connection for the whole request.
     *
     * nullable PDO: will be null until the first time we connect.
     */
    private static ?PDO $connection = null;

    /**
     * Get the PDO connection.
     *
     * The first time this is called, we:
     *   - read credentials from config/db_credentials.php
     *   - create a PDO object
     *   - store it in self::$connection
     *
     * Every later call returns the same PDO instance.
     */
    public static function getConnection(): PDO
    {
        // If we already created a PDO connection, just reuse it.
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        // Build the path to config/db_credentials.php
        //
        // __DIR__ is the folder this file lives in (src/)
        // dirname(__DIR__) is the parent folder (your project root)
        $configPath = dirname(__DIR__) . '/config/db_credentials.php';

        if (!file_exists($configPath)) {
            throw new \RuntimeException(
                'Database config file not found. Expected at: ' . $configPath
            );
        }

        // We expect db_credentials.php to return an associative array.
        $creds = require $configPath;

        if (!is_array($creds)) {
            throw new \RuntimeException(
                'Database config file must return an array of credentials.'
            );
        }

        // Pull values out of the credentials array, with some safe defaults.
        $host     = $creds['host']     ?? 'localhost';
        $dbname   = $creds['dbname']   ?? '';
        $username = $creds['username'] ?? '';
        $password = $creds['password'] ?? '';
        $charset  = $creds['charset']  ?? 'utf8mb4';

        if ($dbname === '') {
            throw new \RuntimeException(
                'Database name (dbname) is missing in db_credentials.php.'
            );
        }

        // Example DSN for MySQL:
        //   mysql:host=localhost;dbname=salamanders;charset=utf8mb4
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $host,
            $dbname,
            $charset
        );

        try {
            // Create the PDO connection.
            self::$connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    // Throw exceptions when something goes wrong
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,

                    // Return rows as associative arrays by default
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

                    // Use real prepared statements when possible
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ]
            );
        } catch (PDOException $e) {
            // Wrap PDOException in a RuntimeException that’s easier
            // for students to catch and display or log.
            throw new \RuntimeException(
                'Database connection failed: ' . $e->getMessage(),
                (int) $e->getCode(),
                $e
            );
        }

        return self::$connection;
    }
}
