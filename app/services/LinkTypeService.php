<?php

namespace App\Services;

use App\Models\LinkType;

class LinkTypeService
{
  public function findAll()
  {
    return LinkType::all();
  }

  public function createLinkType(array $data)
  {
    return LinkType::create($data);
  }

  public function findOne(LinkType $linkType)
  {
    return $linkType;
  }

  public function updateLinkType(LinkType $linkType, array $data)
  {
    $linkType->update($data);
    return $linkType;
  }

  public function deleteLinkType(LinkType $linkType)
  {
    return $linkType->delete();
  }
}
