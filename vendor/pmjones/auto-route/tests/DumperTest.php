<?php declare(strict_types=1);

namespace AutoRoute;

class DumperTest extends \PHPUnit\Framework\TestCase
{
    public function testDumpRoutes()
    {
        $autoRoute = new AutoRoute(
            namespace: 'AutoRoute\\Http',
            directory: __DIR__ . DIRECTORY_SEPARATOR . 'Http',
            baseUrl:   '/api/',
        );

        $dumper = $autoRoute->getDumper();

        $expect = [
            '/api'                                                                                         =>
                [
                    'Get'  => 'AutoRoute\\Http\\Get',
                    'Head' => 'AutoRoute\\Http\\Get',
                ],
            '/api/admin/dashboard'                                                                         =>
                [
                    'Get'  => 'AutoRoute\\Http\\Admin\\Dashboard\\GetAdminDashboard',
                    'Head' => 'AutoRoute\\Http\\Admin\\Dashboard\\GetAdminDashboard',
                ],
            '/api/foo-item'                                                                                =>
                [
                    'Post' => 'AutoRoute\\Http\\FooItem\\PostFooItem',
                ],
            '/api/foo-item/add'                                                                            =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Add\\GetFooItemAdd',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Add\\HeadFooItemAdd',
                ],
            '/api/foo-item/{int:id}'                                                                       =>
                [
                    'Delete' => 'AutoRoute\\Http\\FooItem\\DeleteFooItem',
                    'Get'    => 'AutoRoute\\Http\\FooItem\\GetFooItem',
                    'Head'   => 'AutoRoute\\Http\\FooItem\\HeadFooItem',
                    'Patch'  => 'AutoRoute\\Http\\FooItem\\PatchFooItem',
                ],
            '/api/foo-item/{int:id}/edit'                                                                  =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Edit\\GetFooItemEdit',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Edit\\GetFooItemEdit',
                ],
            '/api/foo-item/{int:id}/extras/{float:foo}/{string:bar}/{mixed:baz}/{bool:dib}[/{array:gir}]'  =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Extras\\GetFooItemExtras',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Extras\\GetFooItemExtras',
                ],
            '/api/foo-item/{int:id}/variadic[/{...string:more}]'                                           =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Variadic\\GetFooItemVariadic',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Variadic\\GetFooItemVariadic',
                ],
            '/api/foo-items/archive[/{int:year}][/{int:month}][/{int:day}]'                                =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItems\\Archive\\GetFooItemsArchive',
                    'Head' => 'AutoRoute\\Http\\FooItems\\Archive\\GetFooItemsArchive',
                ],
            '/api/foo-items[/{int:page}]'                                                                  =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItems\\GetFooItems',
                    'Head' => 'AutoRoute\\Http\\FooItems\\GetFooItems',
                ],
            '/api/repo/{string:ownerName}/{string:repoName}'                                               =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\GetRepo',
                    'Head' => 'AutoRoute\\Http\\Repo\\GetRepo',
                ],
            '/api/repo/{string:ownerName}/{string:repoName}/issue/{int:issueNum}'                          =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\Issue\\GetRepoIssue',
                    'Head' => 'AutoRoute\\Http\\Repo\\Issue\\GetRepoIssue',
                ],
            '/api/repo/{string:ownerName}/{string:repoName}/issue/{int:issueNum}/comment/add'              =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\Add\\GetRepoIssueCommentAdd',
                    'Head' => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\Add\\GetRepoIssueCommentAdd',
                ],
            '/api/repo/{string:ownerName}/{string:repoName}/issue/{int:issueNum}/comment/{int:commentNum}' =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\GetRepoIssueComment',
                    'Head' => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\GetRepoIssueComment',
                ],
        ];

        $actual = $dumper->dump();
        $this->assertSame($expect, $actual);
    }

    public function testDumpRoutes_noBaseUrl()
    {
        $autoRoute = new AutoRoute(
            'AutoRoute\\Http',
            __DIR__ . DIRECTORY_SEPARATOR . 'Http'
        );

        $dumper = $autoRoute->getDumper();

        $expect = [
            '/'                                                                                        =>
                [
                    'Get'  => 'AutoRoute\\Http\\Get',
                    'Head' => 'AutoRoute\\Http\\Get',
                ],
            '/admin/dashboard'                                                                         =>
                [
                    'Get'  => 'AutoRoute\\Http\\Admin\\Dashboard\\GetAdminDashboard',
                    'Head' => 'AutoRoute\\Http\\Admin\\Dashboard\\GetAdminDashboard',
                ],
            '/foo-item'                                                                                =>
                [
                    'Post' => 'AutoRoute\\Http\\FooItem\\PostFooItem',
                ],
            '/foo-item/add'                                                                            =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Add\\GetFooItemAdd',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Add\\HeadFooItemAdd',
                ],
            '/foo-item/{int:id}'                                                                       =>
                [
                    'Delete' => 'AutoRoute\\Http\\FooItem\\DeleteFooItem',
                    'Get'    => 'AutoRoute\\Http\\FooItem\\GetFooItem',
                    'Head'   => 'AutoRoute\\Http\\FooItem\\HeadFooItem',
                    'Patch'  => 'AutoRoute\\Http\\FooItem\\PatchFooItem',
                ],
            '/foo-item/{int:id}/edit'                                                                  =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Edit\\GetFooItemEdit',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Edit\\GetFooItemEdit',
                ],
            '/foo-item/{int:id}/extras/{float:foo}/{string:bar}/{mixed:baz}/{bool:dib}[/{array:gir}]'  =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Extras\\GetFooItemExtras',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Extras\\GetFooItemExtras',
                ],
            '/foo-item/{int:id}/variadic[/{...string:more}]'                                           =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItem\\Variadic\\GetFooItemVariadic',
                    'Head' => 'AutoRoute\\Http\\FooItem\\Variadic\\GetFooItemVariadic',
                ],
            '/foo-items/archive[/{int:year}][/{int:month}][/{int:day}]'                                =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItems\\Archive\\GetFooItemsArchive',
                    'Head' => 'AutoRoute\\Http\\FooItems\\Archive\\GetFooItemsArchive',
                ],
            '/foo-items[/{int:page}]'                                                                  =>
                [
                    'Get'  => 'AutoRoute\\Http\\FooItems\\GetFooItems',
                    'Head' => 'AutoRoute\\Http\\FooItems\\GetFooItems',
                ],
            '/repo/{string:ownerName}/{string:repoName}'                                               =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\GetRepo',
                    'Head' => 'AutoRoute\\Http\\Repo\\GetRepo',
                ],
            '/repo/{string:ownerName}/{string:repoName}/issue/{int:issueNum}'                          =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\Issue\\GetRepoIssue',
                    'Head' => 'AutoRoute\\Http\\Repo\\Issue\\GetRepoIssue',
                ],
            '/repo/{string:ownerName}/{string:repoName}/issue/{int:issueNum}/comment/add'              =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\Add\\GetRepoIssueCommentAdd',
                    'Head' => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\Add\\GetRepoIssueCommentAdd',
                ],
            '/repo/{string:ownerName}/{string:repoName}/issue/{int:issueNum}/comment/{int:commentNum}' =>
                [
                    'Get'  => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\GetRepoIssueComment',
                    'Head' => 'AutoRoute\\Http\\Repo\\Issue\\Comment\\GetRepoIssueComment',
                ],
        ];

        $actual = $dumper->dump();
        $this->assertSame($expect, $actual);
    }
}
