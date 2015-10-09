$(document).ready(function() {
	window.APP = {

		init : function() {
            APP.setListeners();
		},

        setListeners : function() {
            $(document).on('click', '#settings', function() {
                $('#settings-overlay').fadeIn();
            });
            $(document).on('click', '#close-settings', function() {
                APP.buildIframes();
                $('#settings-overlay').fadeOut();
            });
            $(document).on('click', '#refresh', function() {
                $('iframe').each(function(idx, el) {
                    $(el).attr('src', function(i, val) {return val;});
                });
            });
            $(document).on('change', '.size-selection', function() {
                $(this).parents('.form-group').find('input').attr('name', this.value);
            });
            $(document).on('click', '#add-field', function() {
                APP.addField();
            });
            $(document).on('click', '#remove-field', function() {
                $(this).parents('.form-group').remove();
            });
        },

        addField : function() {
            var html = '';
            html += '<div class="form-group">';
            html += '<div class="col-sm-2">';
                html += '<select class="form-control size-selection">';
                    html += '<option value="">Select Size...</option>';
                    html += '<option value="160x600">160 x 600</option>';
                    html += '<option value="180x150">180 x 150</option>';
                    html += '<option value="300x250">300 x 250</option>';
                    html += '<option value="300x600">300 x 600</option>';
                    html += '<option value="640x480">640 x 480</option>';
                    html += '<option value="728x90">728 x 90</option>';
                    html += '<option value="970x90">970 x 90</option>';
                html += '</select>';
            html += '</div>';
            html += '<div class="col-sm-8">';
                html += '<input class="form-control iframe-input" type="text" name=""/>';
            html += '</div>';
            html += '<div class="col-sm-2">';
                html += '<button id="remove-field" class="btn btn-danger btn-block pull-right"><i class="fa fa-close"></i> Remove</button>';
            html += '</div>';
            html += '</div>';
            $('#banner-form').append(html);
        },

        buildIframes : function() {
            $('#insert-iframes').html('');
            $("#banner-form input[type=text]").each(function() {
                if(this.value!='') {
                    var html = '';
                    var dims = this.name.split('x');
                    var w = dims[0];
                    var h = dims[1];
                    var url = this.value;
                    html += '<div class="row">';
                    html += '<div class="col-sm-12">';

                        html += '<iframe width="'+w+'" height="'+h+'" src="'+url+'"></iframe>';
                        html += APP.getText();
                    html += '</div>';
                    html += '</div>';
                    $('#insert-iframes').append(html);
                }
            });
        },

        getText : function() {
            var text = '';
            text += "<p>At, illa, ut vobis placet, partem quandam tuetur, reliquam deserit. Portenta haec esse dicit, neque ea ratione ullo modo posse vivi; Inde sermone vario sex illa a Dipylo stadia confecimus. Atqui, inquam, Cato, si istud optinueris, traducas me ad te totum licebit. Etiam beatissimum? Sint modo partes vitae beatae. Dolere malum est: in crucem qui agitur, beatus esse non potest. Transfer idem ad modestiam vel temperantiam, quae est moderatio cupiditatum rationi oboediens. De quibus cupio scire quid sentias. Rapior illuc, revocat autem Antiochus, nec est praeterea, quem audiamus. </p>";
            text += "<p>Scisse enim te quis coarguere possit? Nam Pyrrho, Aristo, Erillus iam diu abiecti. Bona autem corporis huic sunt, quod posterius posui, similiora. An ea, quae per vinitorem antea consequebatur, per se ipsa curabit? Respondent extrema primis, media utrisque, omnia omnibus. Quae hic rei publicae vulnera inponebat, eadem ille sanabat. At ille non pertimuit saneque fidenter: Istis quidem ipsis verbis, inquit; Gerendus est mos, modo recte sentiat. </p>";
            text += "<p>Etenim semper illud extra est, quod arte comprehenditur. At enim hic etiam dolore. Itaque hic ipse iam pridem est reiectus; Omnes enim iucundum motum, quo sensus hilaretur. At ille pellit, qui permulcet sensum voluptate. Conferam tecum, quam cuique verso rem subicias; Omnia contraria, quos etiam insanos esse vultis. Quae in controversiam veniunt, de iis, si placet, disseramus. Eam stabilem appellas. Miserum hominem! Si dolor summum malum est, dici aliter non potest. </p>";
            text += "<p>Tollenda est atque extrahenda radicitus. Et ais, si una littera commota sit, fore tota ut labet disciplina. Quo plebiscito decreta a senatu est consuli quaestio Cn. Ex quo, id quod omnes expetunt, beate vivendi ratio inveniri et comparari potest. Huius, Lyco, oratione locuples, rebus ipsis ielunior. Vide, quaeso, rectumne sit. Nunc haec primum fortasse audientis servire debemus. At multis se probavit. Quid igitur dubitamus in tota eius natura quaerere quid sit effectum? Ut in voluptate sit, qui epuletur, in dolore, qui torqueatur. </p>";
            return text;
        }

	};
	APP.init();
});
