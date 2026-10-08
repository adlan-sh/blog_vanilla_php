{extends file="layout.tpl"}
{block name=title}{$category->title}{/block}

{block name=content}
    <a href="/" class="back">← На главную</a>
    <h1>{$category->title}</h1>
    <p class="desc">{$category->description}</p>

    <div class="sort-bar">
        Сортировка:
        <a href="/category?id={$category->id}&sort=date"
           class="{if $sort == 'date'}active{/if}">по дате</a>
        <a href="/category?id={$category->id}&sort=views"
           class="{if $sort == 'views'}active{/if}">по просмотрам</a>
    </div>

    <div class="posts-grid">
        {foreach $posts as $post}
            {include file="partials/post_card.tpl" post=$post}
            {foreachelse}
            <p>В этой категории пока нет статей.</p>
        {/foreach}
    </div>

    {if $totalPages > 1}
        <nav class="pagination">
            {for $p=1 to $totalPages}
                <a href="/category?id={$category->id}&sort={$sort}&page={$p}"
                   class="{if $p == $currentPage}active{/if}">{$p}</a>
            {/for}
        </nav>
    {/if}
{/block}