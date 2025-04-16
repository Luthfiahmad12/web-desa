<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class Profile extends Page implements HasForms
{

    use InteractsWithForms;

    protected static string $view = 'filament.pages.profile';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $title = 'Profile Admin';

    protected static ?string $navigationGroup = 'Setting';

    public static bool $shouldRegisterNavigation = true;

    public ?array $data = [];
    public ?Model $user;

    public function mount(): void
    {
        $this->user = User::find(Auth::id());
        $this->form->fill(
            $this->user->toArray()
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->autofocus()
                    ->required(),
                TextInput::make('email')
                    ->required(),
                TextInput::make('password')
                    ->helperText(
                        new HtmlString(
                            '<span style="color:red;font-size:13px;">Kosongkan jika tidak ingin mengubah password</span>'
                        )
                    )
                    ->password()
                    ->revealable()
                    ->nullable()
            ])
            ->statePath('data')
            ->model($this->user);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('Update')
                ->color('primary')
                ->submit('Update'),
        ];
    }

    public function update()
    {
        $data = $this->form->getState();

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $this->user->update($data);

        Notification::make()
            ->title('Profile updated!')
            ->success()
            ->send();

        return redirect(request()->header('Referer'));
    }
}
