{include file="header.tpl"}
<h1>Dokument {$document->document_name}</h1>
Vytvořen: {$document->created_at}<br />
Majitel: {$document->user_id}<br />
Skupina: {$document->group_id}<br />
Oprávnění: {$document->mask}<br />
Velikost: {$document->size} B<br />
{if $permisions->read}
<a href="/document/get/{$document->uuid}_{$document->document_name}">Stáhnout</a>
{/if}
<h2>Aktuální verze</h2>
{if $document->is_latest}
Toto je aktuální verze
{else}
Vytvořen: {$master->created_at}<br />
Majitel: {$master->user_id}<br />
Skupina: {$master->group_id}<br />
Oprávnění: {$master->mask}<br />
Velikost: {$master->size} B<br />
<a href="/document/{$master->uuid}_{$master->document_name}.html">Zobrazit</a>
{/if}
{if $document->is_latest}
<h2>Úpravy</h2>
<form action="/document/{$document->uuid}_{$document->document_name}/put" method="post" enctype="multipart/form-data">
    {if $permisions->write}
Jméno dokumentu: <input type="text" name="document[document_name]" value="{$document->document_name}" /><br />
Nová revize: <input type="file" name="document[content]" /><br />
    {/if}
    {if $user->id eq $document->user_id}
    Maska oprávnění: <input type="text" name="document[mask]" value="{$document->mask}" /><br />
    {/if}
    <input type="submit" value="Zapsat změny" />
</form>
{/if}
<h2>Historie dokumentu</h2>
<ol>
    {foreach from=$histories item=history}
    <li><a href="/document/{$history->document_old_uuid}">{$history->created_at}</a></li>
    {/foreach}
</ol>
<h2>Adresáře</h2>
<ul>
    {foreach from=$directories item=directory}
    <li>
	<a href="/directory/{$directory->id}_{$directory->directory_name}">{$directory->directory_name}</a>
    </li>
    {/foreach}
</ul>
{include file="footer.tpl"}