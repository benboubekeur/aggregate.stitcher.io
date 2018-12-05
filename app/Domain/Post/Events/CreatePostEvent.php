<?php

namespace Domain\Post\Events;

use App\Domain\Post\DTO\PostData;
use Carbon\Carbon;
use Domain\Source\Models\Source;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\EventProjector\ShouldBeStored;

class CreatePostEvent extends DataTransferObject implements ShouldBeStored
{
    /** @var string */
    public $source_uuid;

    /** @var array */
    public $post_data;

    public function __construct(string $source_uuid, array $post_data)
    {
        $post_data['date_created'] = $post_data['date_created'] instanceof Carbon
            ? $post_data['date_created']->toDateTimeString()
            : $post_data['date_created'];

        parent::__construct([
            'source_uuid' => $source_uuid,
            'post_data' => $post_data,
        ]);
    }

    public static function create(Source $source, PostData $postData): CreatePostEvent
    {
        return new self(
            $source->uuid,
            $postData->all()
        );
    }
}