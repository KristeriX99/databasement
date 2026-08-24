@props(['form', 'isEdit' => false])

@include('livewire.database-server.connection._client-server-fields', ['form' => $form, 'isEdit' => $isEdit])

<x-select
    wire:model.live="form.mysql_variant"
    :label="__('Server flavour')"
    :hint="__('Picks the dump client. MySQL uses mysqldump, which skips generated columns that MariaDB’s client writes back as values.')"
    :options="[
        ['id' => 'mariadb', 'name' => __('MariaDB')],
        ['id' => 'mysql', 'name' => __('MySQL (Oracle)')],
    ]"
/>

<x-checkbox
    wire:model.live="form.ssl_enabled"
    :label="__('Use SSL')"
    :hint="__('Required for servers that enforce TLS, such as Amazon RDS with require_secure_transport. The server certificate is not verified.')"
/>
