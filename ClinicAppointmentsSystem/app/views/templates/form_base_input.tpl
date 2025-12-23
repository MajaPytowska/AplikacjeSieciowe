
{* _field.tpl *}
{* Parametry:
    type        (np. "text", "password", "email")
    name        (np. "password")
    id          (opcjonalnie; domyślnie = name)
    value       (opcjonalnie; tekst)
    placeholder (opcjonalnie)
    class       (opcjonalnie; klasa inputa)
    error_class (opcjonalnie; klasa labela błędu)
    attrs       (opcjonalnie; surowe atrybuty np. 'required minlength="8"')
*}

{assign var=__id value=$id|default:$name}
{assign var=__err value=null}

{if $msgs->isMessage($name)}
  {assign var=__err value=$msgs->getMessage($name)->text}
{/if}

<input
  type="{$type|default:'text'|escape}"
  name="{$name|escape}"
  id="{$__id|escape}"
  value="{$value|default:''|escape}"
  placeholder="{$placeholder|default:''|escape}"
  class="{$class|default:''|escape}"
  {if isset($attrs)}{$attrs nofilter}{/if}
/>

{if $__err}
  <label for="{$__id|escape}" class="{$error_class|default:' '|escape}">
    {$__err|escape}
  </label>
{/if}
