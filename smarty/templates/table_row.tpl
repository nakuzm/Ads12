
  <td>{$ad->getId()}</td>
  <td>{$ad->getTitle()}</td>
  <td>{$ad->getDescription()}</td>
  <td>
      <a href="?edit={$ad->getId()}" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Редактировать">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
      </a>
      <a href="?delete={$ad->getId()}" class="btn btn-default" data-toggle="tooltip" data-placement="right" title="Удалить">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
      </a>
  </td>

                                  