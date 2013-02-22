$ ->
  $('.datepicker').datepicker
    format: 'yyyy-mm-dd'
    autoclose: true
    language: 'ja'

  $('.tooltip-target').tooltip()

  $('#btn-article-advanced-search').on 'click', ()->
    $box = $('#article-advanced-search')
    if ($box.hasClass('hide'))
      $box.slideDown().removeClass('hide')
    else
      $box.slideUp().addClass('hide')
    return
  return