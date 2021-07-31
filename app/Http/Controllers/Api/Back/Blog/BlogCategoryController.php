<?php

namespace App\Http\Controllers\Api\Back\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function store(Request $request)
    {
        try {
            $category = BlogCategory::create([
                "title" => $request->title,
                "slug" => Str::slug($request->title)
            ]);
            ob_start();
            ?>
            <tr>
                <!--begin::Checkbox-->
                <td><?= $category->title ?></td>
                <!--end::Checkbox-->
                <td class="text-center">
                    <span class="badge badge-circle badge-primary"><?= $category->blogs()->count() ?></span>
                </td>
                <!--begin::Action=-->
                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">Actions
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-down.svg-->
                        <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)" />
                                        </g>
                                    </svg>
                                </span>
                        <!--end::Svg Icon--></a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="apps/subscriptions/add.html" class="menu-link px-3">Editer</a>
                        </div>
                        <!--end::Menu item-->
                        <div class="menu-item px-3">
                            <a href="apps/subscriptions/add.html" class="menu-link px-3">Supprimer</a>
                        </div>
                    </div>
                    <!--end::Menu-->
                </td>
                <!--end::Action=-->
            </tr>
            <?php

            return response()->json([
                "category" => $category,
                "html" => ob_get_clean()
            ]);
        }catch (\Exception $exception) {
            return $exception;
        }
    }

    public function info($id)
    {
        $category = BlogCategory::find($id);

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        try {
            $category = BlogCategory::find($id);

            $category->update([
                "title" => $request->title,
                "slug" => Str::slug($request->title)
            ]);

            return response()->json($category);
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $category = BlogCategory::find($id);
            $category->delete();

            return response()->json();
        }catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
