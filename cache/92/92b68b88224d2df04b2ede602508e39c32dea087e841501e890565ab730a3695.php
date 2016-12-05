<?php

/* index.html.twig */
class __TwigTemplate_60e1fabc7cf1200da9462152d32057645859d09029217796060577dee414efee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        ob_start();
        // line 2
        echo "<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset=utf-8 />
        <meta content=\"IE=edge\" http-equiv=X-UA-Compatible />
        <meta content=\"width=device-width,initial-scale=1\" name=viewport />

        <title>Username Management | Owners</title>

        <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" integrity=\"sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u\" crossorigin=\"anonymous\">

        <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
        <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
        <![endif]-->
        <style>
            .margin-left-7 {
                margin-left: 7px !important;
            }

            .margin-bottom-17 {
                margin-bottom: 17px !important;
            }

            .margin-top-7 {
                margin-top: 7px !important;
            }

            .container-full {
                margin: 0 auto;
                width: 100%;
            }

            .form-inline > .form-group > .form-control {
                width: 77%;
            }
        </style>
    <body>
        <div class=\"container-full margin-top-7\">
            <div role=\"row\">
                <div class=\"col-md-12 margin-bottom-17\">
                    <form class=\"form-inline form\" enctype=\"application/x-www-form-urlencoded\">
                        <div class=\"form-group col-md-3\">
                            <label for=\"name\">Nama:</label>
                            <input type=\"text\" class=\"form-control margin-left-7 name\" id=\"name\" name=\"filters[name]\" placeholder=\"Masukkan Nama\">
                        </div>
                        <div class=\"form-group col-md-3\">
                            <label for=\"email\">Email:</label>
                            <input type=\"text\" class=\"form-control margin-left-7 email\" id=\"email\" name=\"filters[email]\" placeholder=\"Masukkan Email\">
                        </div>
                        <div class=\"form-group col-md-3\">
                            <label for=\"ip_address\">Ip Address:</label>
                            <input type=\"text\" class=\"form-control margin-left-7 ip_address\" id=\"ip_address\" name=\"filters[ip_address]\" placeholder=\"Masukkan Ip Address\">
                        </div>
                        <button type=\"submit\" class=\"btn btn-success col-md-3 search\">Cari</button>
                    </form>
                </div>
            </div>
            <div role=\"row\">
                <div class=\"col-md-12\">
                    <table class=\"table table-responsive table-striped\">
                        <thead>
                            <tr class=\"warning\">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Ip Address</th>
                                <th>Api Key</th>
                                <th>Storage</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["owners"]) ? $context["owners"] : null));
        foreach ($context['_seq'] as $context["k"] => $context["owner"]) {
            // line 75
            echo "<tr>
                                <td>";
            // line 76
            echo twig_escape_filter($this->env, ($context["k"] + 1), "html", null, true);
            echo "</td>
                                <td>";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "name", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 78
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "email", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 79
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "ipAddress", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 80
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "api", array()), "html", null, true);
            echo "</td>
                                <td>";
            // line 81
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "usernameStorage", array()), "html", null, true);
            echo "</td>
                                <td>
                                    <button data-id=\"";
            // line 83
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "id", array()), "html", null, true);
            echo "\" data-name=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "name", array()), "html", null, true);
            echo "\" data-email=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "email", array()), "html", null, true);
            echo "\" data-ip=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "ipAddress", array()), "html", null, true);
            echo "\" class=\"btn btn-warning edit\">Edit</button>
                                    <button data-id=\"";
            // line 84
            echo twig_escape_filter($this->env, $this->getAttribute($context["owner"], "id", array()), "html", null, true);
            echo "\" class=\"btn btn-danger delete margin-left-7\">Delete</button>
                                </td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['owner'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 88
        echo "                    </table>
                </div>
                <div class=\"col-md-12\">
                    <button class=\"btn btn-primary margin-top-7 add-new\">Tambah Baru</button>
                    <button class=\"btn btn-primary margin-top-7 pull-right clear\">Muat Ulang</button>
                </div>
            </div>
        </div>

        <div class=\"modal fade modal-message\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"success\">
            <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">Pesan</div>
                    <div class=\"modal-body message\"></div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-primary confirm-close\" data-dismiss=\"modal\">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"modal fade modal-message-delete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"success\">
            <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">Pesan</div>
                    <div class=\"modal-body message\">Anda yakin akan menghapus data ini?</div>
                    <div class=\"modal-footer\">
                        <button type=\"button\" class=\"btn btn-danger confirm-delete\" data-dismiss=\"modal\">Hapus</button>
                        <button type=\"button\" class=\"btn btn-primary confirm-close\" data-dismiss=\"modal\">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
        <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\" integrity=\"sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa\" crossorigin=\"anonymous\"></script>
        <script type=\"text/javascript\">
            jQuery(document).ready(function () {
                init();

                jQuery('.form').submit(function (e) {
                    e.preventDefault();
                });

                jQuery(document).on('click', '.search', function (e) {
                    e.preventDefault();
                    var \$this = jQuery(this);

                    if ('undefined' !== typeof \$this.data('id')) {
                        if (0 === \$this.data('id')) {
                            jQuery.ajax({
                                method: 'POST',
                                url: '/owner/create?api=' + getParameterByName('api'),
                                data: {
                                    owner: {
                                        name: jQuery('.name').val(),
                                        email: jQuery('.email').val(),
                                        ip_address: jQuery('.ip_address').val()
                                    }
                                }
                            })
                            .done(function(response) {
                                jQuery('.message').html(response.message);
                                jQuery('.modal-message').modal({
                                    keyboard: false
                                });
                            })
                            .fail(function (response) {
                                var responseText = JSON.parse(response.responseText);
                                jQuery('.message').html(responseText.message);
                                jQuery('.modal-message').modal({
                                    keyboard: false
                                });
                            });
                        } else {
                            jQuery.ajax({
                                method: 'PUT',
                                url: '/owner/edit/' + \$this.data('id') + '?api=' + getParameterByName('api'),
                                data: {
                                    owner: {
                                        name: jQuery('.name').val(),
                                        email: jQuery('.email').val(),
                                        ip_address: jQuery('.ip_address').val()
                                    }
                                }
                            })
                            .done(function(response) {
                                jQuery('.message').html(response.message);
                                jQuery('.modal-message').modal({
                                    keyboard: false
                                });
                            })
                            .fail(function (response) {
                                var responseText = JSON.parse(response.responseText);
                                jQuery('.message').html(responseText.message);
                                jQuery('.modal-message').modal({
                                    keyboard: false
                                });
                            });
                        }
                    } else {
                        var api = getParameterByName('api');
                        var name = jQuery('.name').val();
                        var email = jQuery('.email').val();
                        var ip_address = jQuery('.ip_address').val();
                        var url = getURL();

                        window.location = url + '?api=' + api + '&filters[name]=' + name + '&filters[email]=' + email + '&filters[ip_address]=' + ip_address;
                    }

                    return false;
                });

                jQuery(document).on('click', '.confirm-close', function (e) {
                    e.preventDefault();

                    window.location.reload();
                });

                jQuery(document).on('click', '.delete', function (e) {
                    e.preventDefault();
                    var \$this = jQuery(this);

                    jQuery('.confirm-delete').data('id', \$this.data('id'));

                    jQuery('.modal-message-delete').modal({
                        keyboard: false
                    });
                });

                jQuery(document).on('click', '.confirm-delete', function (e) {
                    e.preventDefault();
                    var \$this = jQuery(this);
                    jQuery.ajax({
                        method: 'DELETE',
                        url: '/owner/delete/' + \$this.data('id') + '?api=' + getParameterByName('api'),
                        data: {}
                    })
                    .done(function(response) {
                        jQuery('.message').html(response.message);
                        jQuery('.modal-message').modal({
                            keyboard: false
                        });
                    })
                    .fail(function (response) {
                        var responseText = JSON.parse(response.responseText);
                        jQuery('.message').html(responseText.message);
                        jQuery('.modal-message').modal({
                            keyboard: false
                        });
                    });
                });

                jQuery(document).on('click', '.clear', function (e) {
                    e.preventDefault();
                    var location = window.location;

                    window.location = location.protocol + '//' + location.host + location.pathname + '?api=' + getParameterByName('api');
                });

                jQuery(document).on('click', '.edit', function (e) {
                    e.preventDefault();

                    var button = jQuery('.search');
                    var \$this = jQuery(this);

                    button.html('Update');
                    button.data('id', \$this.data('id'));
                    jQuery('.name').val(\$this.data('name'));
                    jQuery('.email').val(\$this.data('email'));
                    jQuery('.ip_address').val(\$this.data('ip'));
                });

                jQuery(document).on('click', '.add-new', function (e) {
                    e.preventDefault();

                    var button = jQuery('.search');

                    button.html('Simpan');
                    button.data('id', 0);

                    init();
                });
            });

            function init() {
                jQuery('.name').val('');
                jQuery('.email').val('');
                jQuery('.ip_address').val('');
            }

            function getParameterByName(name, url) {
                if (!url) {
                    url = window.location.href;
                }

                name = name.replace(/[\\[\\]]/g, \"\\\\\$&\");
                var regex = new RegExp(\"[?&]\" + name + \"(=([^&#]*)|&|#|\$)\"),
                    results = regex.exec(url);
                if (!results) return null;
                if (!results[2]) return '';
                return decodeURIComponent(results[2].replace(/\\+/g, \" \"));
            }

            function getURL() {
                return location.protocol + '//' + location.host + location.pathname;
            }
        </script>
    </body>
</html>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 88,  136 => 84,  126 => 83,  121 => 81,  117 => 80,  113 => 79,  109 => 78,  105 => 77,  101 => 76,  98 => 75,  94 => 74,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "index.html.twig", "/home/aden/Playground/UsernameManager/html/index.html.twig");
    }
}
