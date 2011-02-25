{include file="header.tpl"}
{foreach from=$path item=parent}
/<a href="/directory/{$parent->id}_{$parent->directory_name}">{$parent->directory_name}</a>
{/foreach}
<h1>/{$this->directory_name}</h1>
{if $permisions->write}
<h2>Přejmenovat adresář</h2>
<form action="/directory/{$this->id}_{$this->directory_name}/put" method="post">
    Nové jméno: <input type="text" name="directory[directory_name]" /><br />
    <input type="submit" value="Přejmenovat adresář" />
</form>
{/if}
{if $this->user_id eq $_user->id}
<h2>Změnit oprávění</h2>
<form action="/directory/{$this->id}_{$this->directory_name}/put" method="post">
    Nové oprávnění: <input type="text" name="directory[mask]" value="{$this->mask}" /><br />
    <input type="submit" value="Uložit změny v oprávnění" />
</form>
{/if}
<h2>Obsah adresáře</h2>
<table>
    <thead>
        <tr>
            <th>
                Typ
            </th>
            <th>
                Jméno
            </th>
            <th>
                Uživatel
            </th>
            <th>
                Skupina
            </th>
            <th>
                Oprávnění
            </th>
            <th>
                Vytvořen
            </th>
            <th>
                Poslední změna
            </th>
            <th>
                Operace
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                D
            </td>
            <td>
                <a href="/directory/{$this->id}_{$this->directory_name}">.</a>
            </td>
            <td>
                {$this->user_id}
            </td>
            <td>
                {$this->group_id}
            </td>
            <td>
                {$this->mask}
            </td>
            <td>
                {$this->created_at}
            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        <tr>
            <td>
                D
            </td>
            <td>
                <a href="/directory/{$directParent->id}_{$directParent->directory_name}">..</a>
            </td>
            <td>
                {$directParent->user_id}
            </td>
            <td>
                {$directParent->group_id}
            </td>
            <td>
                {$directParent->mask}
            </td>
            <td>
                {$directParent->created_at}
            </td>
            <td>
                -
            </td>
            <td>
                -
            </td>
        </tr>
        {foreach from=$subdirs item=dir}
        <tr>
            <td>
                D
            </td>
            <td>
                <a href="/directory/{$dir->id}_{$dir->directory_name}">{$dir->directory_name}</a>
            </td>
            <td>
                {$dir->user_id}
            </td>
            <td>
                {$dir->group_id}
            </td>
            <td>
                {$dir->mask}
            </td>
            <td>
                {$dir->created_at}
            </td>
            <td>
                -
            </td>
            <td>
                <a href="/directory/{$dir->id}_{$dir->directory_name}/delete">Smazat</a>
            </td>
        </tr>
        {/foreach}
	{foreach from=$files item=file}
	<tr>
            <td>
                F
            </td>
            <td>
                <a href="/document/{$file->uuid}_{$file->document_name}">{$file->document_name}</a>
            </td>
            <td>
                {$file->user_id}
            </td>
            <td>
                {$file->group_id}
            </td>
            <td>
                {$file->mask}
            </td>
            <td>
                {$file->created_at}
            </td>
            <td>
                -
            </td>
            <td>
                <a href="/document/{$file->uuid}_{$file->document_name}/put?directory[id]={$this->id}&directory[method]=delete">Odebrat</a>
            </td>
        </tr>
	{/foreach}
    </tbody>
</table>
{if $permisions->write}
<h2>Přidat adresář</h2>
<form action="/directory/{$this->id}_{$this->directory_name}/post" method="post">
    Jméno nového adresáře: <input type="text" name="directory[directory_name]" /><br />
    <input type="submit" value="Vytvořit adresář" />
</form>
<h2>Přidat dokument</h2>
<form action="/document/post" method="post" enctype="multipart/form-data">
    Soubor: <input type="file" name="document[content]" /><br />
    <input type="hidden" name="directory[id]" value="{$this->id}" />
    <input type="submit" value="Odeslat dokument" />
</form>
{/if}
{include file="footer.tpl"}