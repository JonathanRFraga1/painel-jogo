
/**
 * Função responsavel pela exibição da notificação
 *
 * @param {string} title titulo da notificação
 * @param {string} content conteúdo da notificação
 * @param {string} type tipo da notificação
 */
function exibeNotificacao(title, content, type) {
    let notification = $('#notification-alert');
    $('#title-notification').html(title);
    $('#message-notification').html(content);
    notification.addClass(type);
    notification.addClass('show');
    setTimeout(() => {
        notification.removeClass('show');
    }, 5000);
}
