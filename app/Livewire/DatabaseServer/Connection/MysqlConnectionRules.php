<?php

namespace App\Livewire\DatabaseServer\Connection;

use App\Livewire\DatabaseServer\Form;
use App\Services\Backup\Databases\MysqlDatabase;
use Illuminate\Validation\Rule;

class MysqlConnectionRules extends ClientServerConnectionRules
{
    public function rules(Form $form): array
    {
        return array_merge(parent::rules($form), [
            'mysql_variant' => ['nullable', 'string', Rule::in(MysqlDatabase::variants())],
        ]);
    }

    public function extraConfig(Form $form): array
    {
        return array_filter([
            'ssl_enabled' => $form->ssl_enabled ?: null,
            'mysql_variant' => $form->mysql_variant === MysqlDatabase::VARIANT_MYSQL ? MysqlDatabase::VARIANT_MYSQL : null,
        ], fn ($value) => $value !== null);
    }

    public function dumpPreviewConfig(Form $form): array
    {
        // Unlike extraConfig(), this sends the variant either way so the
        // preview tracks the select instead of only its non-default value.
        return [
            'ssl_enabled' => $form->ssl_enabled,
            'mysql_variant' => $form->mysql_variant,
        ];
    }
}
