<?php

namespace App\Repositories\Repository\Admin;

use App\Models\User;
use App\Repositories\Interfaces\Admin\IUserRepository;
use App\Repositories\Repository\BaseRepository;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Intervention\Image\ImageManagerStatic as Image;

class UserRepository extends BaseRepository implements IUserRepository
{
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  public function paginated(int $perPage, ?array $relations, ?string $searchQuery)
  {
    $users = $this->model;

    if ($relations) $users = $users->with($relations);

    if ($searchQuery) {
      $users = $users
                ->where('name', 'ILIKE', '%' . $searchQuery . '%')
                ->orWhere('npk', 'ILIKE', '%' . $searchQuery . '%');
    }

    return $users->orderBy('created_at', 'desc')->paginate($perPage)->appends(['search' => $searchQuery]);
  }

  public function save(array $attributes)
  {
    $attributesBind = $this->objectStoreMapping($attributes);

    $result = $this->model->create($attributesBind);

    return $result;
  }

  public function getByUuid(string $uuid, ?array $relations, ?bool $isShow = false)
  {
    $user = $this->model->where('id', $uuid);

    $this->checkIfExist($user);

    if ($relations) $user = $user->with($relations);

    return $user->first();
  }

  public function delete(string $uuid)
  {
    $this->getByUuid($uuid, null)->delete();
  }

  public function passwordReset(string $uuid)
  {
    $user = $this->getByUuid($uuid, null);
    $user->password = bcrypt('12345678');

    $user->save();

    return $user;
  }

  public function updates(string $uuid, array $attributes)
  {
    $mappedAttributes = $this->objectUpdateMapping($attributes);
    $user = $this->getByUuid($uuid, null);

    $user->update($mappedAttributes);

    return $user;
  }

  public function changeProfile(array $attributes, string $uuid)
  {
    $data = $this->profileUpdateMapper($attributes);

    $user = $this->updates($uuid, $data);

    if (isset($attributes['photo'])) {
      $this->storeImage($user, $attributes['photo']);
    }

    return $user;
  }

  public function changePassword(string $password, string $uuid)
  {
    $user = $this->getByUuid($uuid, null);

    $user->password = bcrypt($password);
    $user = $user->save();

    return $user;
  }

  private function storeImage($user, $image)
  {
    $imageFile = $image->store('profile', 'public');

    $this->resizeImage($imageFile);

    if (!$user->image) {
      $user->image()->create([
        'path' => $imageFile
      ]);
    } else {
      $user->image()->update([
        'path' => $imageFile
      ]);
    }
  }

  private function resizeImage($file)
  {
    $resizedImage = Image::make('storage/' . $file)->resize(300, null, function($constraint) {
        $constraint->aspectRatio();
    });

    $resizedImage->save();
  }

  private function profileUpdateMapper(array $attributes)
  {
    $attributes['name'] = $attributes['first_name'] . ' ' . $attributes['last_name'];
    unset($attributes['first_name'], $attributes['last_name']);
    return $attributes;
  }

  private function objectUpdateMapping(array $attributes)
  {
    if (isset($attributes['division'])) $attributes['division_id'] = $attributes['division'];

    $accepted = Arr::only($attributes, ['name', 'division_id']);

    return $accepted;
  }

  private function objectStoreMapping(array $attributes)
  {
    $attributes['id'] = Str::uuid();
    $attributes['password'] = bcrypt('12345678');
    $attributes['division_id'] = $attributes['division'];

    unset($attributes['division']);

    return $attributes;
  }
}