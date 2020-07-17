<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование профиля пользователя
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN; ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
        <li><a href="<?= ADMIN; ?>/user">Список пользователей</a></li>
        <li class="active">Редактирование профиля пользователя</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?= ADMIN; ?>/user/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="login">Логин</label>
                            <input type="text" class="form-control" name="login" id="login"
                                   value="<?= checkUserData($user->login); ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Введите новый пароль для изменения">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   value="<?= checkUserData($user->name); ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                   value="<?= checkUserData($user->email); ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   value="<?= checkUserData($user->address); ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Роль</label>
                            <select name="role" id="role" class="form-control">
                                <option value="user"<?php if ($user->role === 'user') {
                                    echo ' selected';
                                }; ?>>Пользователь
                                </option>
                                <option value="admin"<?php if ($user->role === 'admin') {
                                    echo ' selected';
                                }; ?>>Администратор
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?= $user->id; ?>">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
            <h3>Заказы пользователя</h3>
            <div class="box">
                <div class="box-body">
                    <?php if ($orders): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Статус</th>
                                    <th>Сумма</th>
                                    <th>Дата создания</th>
                                    <th>Дата изменения</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orders as $order): ?>
                                    <?php $class = ($order['status'] === 'Завершен') ? 'success' : ''; ?>
                                    <tr class="<?= $class; ?>">
                                        <td><?= $order['id']; ?></td>
                                        <td><?= $order['status']; ?></td>
                                        <td><?= $order['sum']; ?> <?= $order['currency']; ?></td>
                                        <td><?= $order['date']; ?></td>
                                        <td><?= $order['update_at']; ?></td>
                                        <td><a href="<?= ADMIN; ?>/order/view?id=<?= $order['id']; ?>">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-danger">Заказов пока нет...</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->



