{extends file="layout.tpl"}
{block name=title}Главная{/block}

{block name=content}
    <h1>Последние статьи по категориям</h1>

    {foreach $data as $value}
        <section class="category-block">
            <header>
                <h2>{$value.category->title}</h2>
                <p>{$value.category->description}</p>
            </header>

            {if $value.posts}
                <div class="posts-grid">
                    {foreach $value.posts as $post}
                        {include file="partials/post_card.tpl" post=$post}
                    {/foreach}
                </div>
            {else}
                <p class="empty">В этой категории пока нет статей.</p>
            {/if}

            <a class="btn" href="/category?id={$value.category->id}">Все статьи →</a>
        </section>
    {/foreach}
{/block}