<?php

declare(strict_types=1);

namespace App\Orchid\Presenters\Resources;

use App\Models\Resources\NDItem;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class NDItemPresenter extends Presenter implements Searchable, Personable
{
    /**
     * Returns the label for this presenter, which is used in the UI to identify it.
     */
    public function label(): string
    {
        return 'ND Items';
    }

    /**
     * Returns the title for this presenter, which is displayed in the UI as the main heading.
     */
    public function title(): string
    {
        return $this->entity->name;
    }

    /**
     * Returns the subtitle for this presenter, which provides additional context about the user.
     */
    public function subTitle(): string
    {
        return collect($this->entity->toSearchableArray())->filter(fn($v, $k) => !empty($v) && $k !== 'id')->join(' | ');
    }

    /**
     * Returns the URL for this presenter, which is used to link to the user's edit page.
     */
    public function url(): string
    {
        return route('platform.' . NDItem::slug() . '.item.view', $this->entity);
    }

    /**
     * Returns the URL for the user's Gravatar image, or a default image if one is not found.
     */
    public function image(): ?string
    {
        return null;
    }

    /**
     * Returns the number of models to return for a compact search result.
     * This method is used by the search functionality to display a list of matching results.
     */
    public function perSearchShow(): int
    {
        return 10;
    }

    /**
     * Returns a Laravel Scout builder object that can be used to search for matching users.
     * This method is used by the search functionality to retrieve a list of matching results.
     */
    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }
}
