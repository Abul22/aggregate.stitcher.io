<?php

namespace App\Http\Controllers;

use App\Http\Requests\SourceRequest;
use App\Http\ViewModels\SourceViewModel;
use Domain\Source\Actions\CreateSourceAction;
use Domain\Source\Actions\DeleteSourceAction;
use Domain\Source\Actions\UpdateSourceAction;
use Domain\Source\DTO\SourceData;
use Domain\User\Models\User;

final class UserSourcesController
{
    public function index(User $user)
    {
        $viewModel = new SourceViewModel($user);

        return $viewModel->view('userSources.index');
    }

    public function update(
        SourceRequest $request,
        User $user,
        CreateSourceAction $createSourceAction,
        UpdateSourceAction $updateSourceAction
    ) {
        $primarySource = $user->getPrimarySource();

        if (! $primarySource) {
            $createSourceAction($user, SourceData::fromRequest($request));

            return redirect()->action([self::class, 'index']);
        }

        $updateSourceAction($primarySource, SourceData::fromRequest($request, $primarySource));

        return redirect()->action([self::class, 'index']);
    }

    public function delete(
        User $user,
        DeleteSourceAction $deleteSourceAction
    ) {
        $primarySource = $user->getPrimarySource();

        if (! $primarySource) {
            return redirect()->action([self::class, 'index']);
        }

        $deleteSourceAction($primarySource);

        return redirect()->action([self::class, 'index']);
    }
}
