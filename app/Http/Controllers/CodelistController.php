<?php

namespace App\Http\Controllers;

class CodelistController extends Controller
{
    public function get()
    {
        return json_decode(<<<EOT
{
  "marital_statuses": [
    {
      "code": "single",
      "name": {
        "m": "slobodný",
        "f": "slobodná",
        "general": "slobodný / slobodná"
      }
    }
  ],
  "genders": [
    {
      "code": "m",
      "name": "muž"
    }
  ],
  "titles_before": [
    {
      "code": "Bc.",
      "name": "Bc."
    }
  ],
  "titles_after": [
    {
      "code": "CSc.",
      "name": "CSc."
    }
  ]
}
EOT
);
    }
}
