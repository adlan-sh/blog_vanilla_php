{extends file="layout.tpl"}
{block name=title}Главная{/block}

{block name=content}
    <h1>Последние статьи по категориям</h1>

    {foreach $blocks as $block}
        <section class="category-block">
            <header>
                <h2>{$block.category->title}</h2>
                <p>{$block.category->description}</p>
            </header>

            {if $block.posts}
                <div class="posts-grid">
                    {foreach $block.posts as $post}
                        {include file="partials/post_card.tpl" post=$post}
                    {/foreach}
                </div>
            {else}
                <p class="empty">В этой категории пока нет статей.</p>
            {/if}

            <a class="btn" href="/category?id={$block.category->getId()}">Все статьи →</a>
        </section>
    {/foreach}
{/block}