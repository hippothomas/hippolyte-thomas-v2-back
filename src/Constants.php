<?php

namespace App;

class Constants
{
    /**
     * The current release version
     * Follows the Semantic Versioning strategy: https://semver.org/.
     */
    public const string VERSION = '1.1.1';
    /**
     * The current release: major * 10000 + minor * 100 + patch.
     */
    public const int VERSION_ID = 10101;
    /**
     * Main Website URL.
     */
    public const string MAIN_WEBSITE = 'https://hippolyte-thomas.fr/';
}
