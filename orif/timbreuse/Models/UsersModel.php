<?php
namespace Timbreuse\Models;

use CodeIgniter\Model;

class UserModel extends Model 
{
    protected $table = 'user_sync';
    protected $primaryKey ='id_user';
    protected $allowedFields = ['name', 'surname', 'date_delete'];

    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = 'date_modif';
    protected $deletedField  = 'date_delete';
    protected $dateFormat = 'datetime';

    public function get_user($userId)
    {
        return $this->find($userId);
    }

    public function get_users(bool $with_deleted = false)
    {
        $this->orderBy('surname');
        return $this->select('user_sync.id_user, surname, user_sync.name, username, email, fk_user_type, archive, user_type.name AS user_type')
                    ->join('access_tim_user', 'user_sync.id_user = access_tim_user.id_user', 'left')
                    ->join('user', 'user.id = access_tim_user.id_ci_user', 'left')
                    ->join('user_type', 'user.fk_user_type = user_type.id', 'left')
                    ->withDeleted($with_deleted)
                    ->findAll();
    }

    public function is_replicate(string $name, string $surname): bool
    {
        $this->where('name =', $name);
        $this->where('surname =', $surname);
        return boolval($this->findAll());
    }

    public function get_names(int $userId): array
    {
        return $this->select('name, surname')->find($userId);
    }

    public function get_available_users_info(): array
    {
        $data = $this->select('user_sync.id_user, name, surname')
            ->join('badge_sync', 'user_sync.id_user = badge_sync.id_user',
                'left')
            ->where('id_badge', null)
            ->orderBy('surname')
            ->findall();
        return $data ?? array();
    }

}
