{extends file="layout.tpl"}
{block name=title}404 — Страница не найдена{/block}

{block name=content}
    <div class="error-page">
        <h1 class="error-code">404</h1>
        <h2>Страница не найдена</h2>
        <p class="error-message">{$message|default:'Похоже, этой страницы больше нет или она никогда не существовала.'}</p>
        <p>
            <a class="btn" href="/">← Вернуться на главную</a>
        </p>
    </div>
{/block}