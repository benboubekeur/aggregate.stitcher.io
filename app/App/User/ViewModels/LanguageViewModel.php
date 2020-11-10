<?php

namespace App\User\ViewModels;

use Domain\Language\Language;
use Domain\Language\LanguageRepository;
use Spatie\ViewModels\ViewModel;

final class LanguageViewModel extends ViewModel
{
    /** @var \Domain\Language\LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function languageOptions(): array
    {
        return array_merge(
            [
            null => '-',
        ],
            $this->languageRepository->all()
            ->mapWithKeys(fn (Language $language) => [$language->code => $language->name])
            ->toArray()
        );
    }
}
