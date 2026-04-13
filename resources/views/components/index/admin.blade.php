<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <x-ui.card :title="__('admin.user_title')" :description="__('admin.user_desc')" icon="fas-user" href="/manage/users" />

    <x-ui.card :title="__('admin.classroom_title')" :description="__('admin.classroom_desc')" icon="fas-door-open" href="/manage/classrooms" />

    <x-ui.card :title="__('admin.group_title')" :description="__('admin.group_desc')" icon="fas-user-group" href="/manage/groups" />

</div>
